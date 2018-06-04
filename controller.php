<?php
session_start();
include 'Model.php';
include 'Employee.php';
$employee = new Employee();
$employee->resetMsg();
switch (true) {
    case isset($_POST['Get_Employee']):

        $employee = new Employee();

        if ($employee->validateId($_POST['id'])) {
            $result = $employee->runDb2(
                "SELECT * FROM employees WHERE id=:id",
                array(":id" => $employee->getId()),
                'single'
            );
            if (empty($result)) {
                $employee->addToMsg("Id is not in DB");
                $employee->msg();
                output();
                break;
            } else {
                $employee->addToMsg(json_encode($result, JSON_PRETTY_PRINT));
            }
        }
        $employee->clearForm();
        $employee->msg();
        output();
        break;

    case isset($_POST['Add_New']):
        $employee->validateId($_POST['id']);
        $employee->validateName($_POST['name']);
        if (strlen($employee->msg()) > 1) {
            $employee->msg();
            output();
            break;
        }
        // //
        $result = $employee->runDb2(
            "INSERT INTO employees(id, name) VALUES(:id,:fname)",
            array(":id" => $employee->getId(), ":fname" => $employee->getName()),
            'none'
        );

        if ($result != "") {
            if ($result->errorInfo[1] == 1062) {
                $employee->addToMsg("Add new failed,Id already exists");
            } else {
                $employee->addToMsg("fatal error processing request:" . json_encode($result));
            }
            $employee->msg();
            output();
            break;
        }
        //
        $employee->addToMsg($employee->getName() . " was added to DB,new id: " . $employee->getId());
        $employee->clearForm();
        $employee->msg();
        output();
        break;

    case isset($_POST['Update_Employee']):

        $employee->validateId($_POST['id']);
        $employee->validateName($_POST['name']);
        if (strlen($employee->msg()) > 1) {
            $employee->msg();
            output();
            break;
        }
        //
        $result = $employee->runDb2(
            "UPDATE employees SET name = :fname WHERE id = :id;",
            array(":id" => $employee->getId(), ":fname" => $employee->getName()),
            'rowCount'
        );
        //
        if (empty($result)) {
            $employee->addToMsg("Update failed,possible reasons:
            <ol>
            <li>Id already in DB</li>
            <li>id is not in DB</li>
            <li>new name is same as old</li>
            </ol>");
        } else {
            $employee->addToMsg("update of id:" . $employee->getId() . " succesful!");
            $employee->clearForm();
        }
        $employee->msg();
        output();
        break;

    case isset($_POST['Delete_Employee']):

        $employee->validateId($_POST['id']);
        if (strlen($employee->msg()) > 1) {
            $employee->msg();
            output();
            break;
        }
        //
        $result = $employee->runDb2(
            "DELETE FROM employees WHERE id= :id",
            array(":id" => $employee->getId()),
            'rowCount'
        );
        //
        if ($result < 1) {
            $employee->addToMsg("Delete failed,Id not found");
        } else {
            $employee->addToMsg($employee->getId() . " deleted from DB");
            $employee->clearForm();
        }
        $employee->msg();
        output();
        break;

    case isset($_POST['Get_All_Employees']):
        $result = $employee->runDb2(
            "SELECT * FROM employees",
            array(),
            'resultset'
        );
        if (empty($result)) {
            $employee->addToMsg("There are no employees on record");
        } else {
            $employee->addToMsg(json_encode($result, JSON_PRETTY_PRINT));
        }
        $employee->msg();
        $employee->clearForm();
        output();
        break;
}

//helpers
function output()
{
    return header("Location: index.php");
}

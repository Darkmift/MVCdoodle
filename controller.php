<?php
session_start();
include 'Model.php';

switch (true) {
    case isset($_POST['Get_Employee']):
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $statement = $db->prepare("select * from employees where id = :id");
            $statement->execute(array(':id' => $_POST['id']));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $result = $row;
            if (empty($result)) {
                $_SESSION['Result_from_Model'] = "Id is not in DB";
            } else {
                $_SESSION['Result_from_Model'] = $result;
            }
            header("Location: index.php");
        } else {
            $_SESSION['Result_from_Model'] = "Please input Id and try again";
            header("Location: index.php");
        }
        break;

    case isset($_POST['Add_New']):
        $msg = "";
        if (!is_numeric($_POST['id'])) {
            $msg .= "please input id<br>";
        } else {
            $id = $_SESSION['id'] = $_POST['id'];
        }
        if ($_POST['name'] == "") {
            $msg .= "please input name<br>";
        } else {
            $name = $_SESSION['name'] = $_POST['name'];
        }

        if ($msg != "") {
            output($msg);
            break;
        }
        $statement = $db->prepare("INSERT INTO employees(id, name)
        VALUES(:id,:fname)");
        $statement->execute(array(
            "id" => $id,
            "fname" => $name,
        ));
        $result = $statement->rowCount();
        if (empty($result)) {
            $_SESSION['Result_from_Model'] = "Add new failed,Id already exists";
        } else {
            $_SESSION['Result_from_Model'] = "$name was added to DB!";
            unset($_SESSION['id']);
            unset($_SESSION['name']);
        }

        header("Location: index.php");
        break;

    case isset($_POST['Update_Employee']):
        $msg = "";
        if (!is_numeric($_POST['id'])) {
            $msg .= "please input id<br>";
        } else {
            $id = $_SESSION['id'] = $_POST['id'];
        }
        if ($_POST['name'] == "") {
            $msg .= "please input name<br>";
        } else {
            $name = $_SESSION['name'] = $_POST['name'];
        }

        if ($msg != "") {
            output($msg);
            break;
        }
        $statement = $db->prepare("UPDATE employees SET name = :fname WHERE id = :id;");
        $statement->execute(array(
            "id" => $id,
            "fname" => $name,
        ));
        $result = $statement->rowCount();
        if (empty($result)) {
            $_SESSION['Result_from_Model'] = "Update failed,possible reasons:
            <ol>
            <li>Id already in DB</li>
            <li>id is not in DB</li>
            <li>new name is same as old</li>
            </ol>";
        } else {
            $_SESSION['Result_from_Model'] = "update of $id succesful!";
            unset($_SESSION['id']);
            unset($_SESSION['name']);
        }

        header("Location: index.php");
        break;

    case isset($_POST['Delete_Employee']):
        $msg = "";
        if (!is_numeric($_POST['id'])) {
            $msg .= "please input id<br>";
        } else {
            $id = $_SESSION['id'] = $_POST['id'];
        }

        if ($msg != "") {
            output($msg);
            break;
        }
        $statement = $db->prepare("DELETE FROM employees WHERE id= :id");
        $statement->execute(array(
            "id" => $id,
        ));
        $result = $statement->rowCount();
        if ($result < 1) {
            $_SESSION['Result_from_Model'] = "Delete failed,Id not found";
        } else {
            $_SESSION['Result_from_Model'] = "$id deleted from DB";
            unset($_SESSION['id']);
            unset($_SESSION['name']);
        }
        header("Location: index.php");
        break;

    case isset($_POST['Get_All_Employees']):
        $statement = $db->prepare("SELECT * FROM employees");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            $_SESSION['Result_from_Model'] = "There are no employees on record";
        } else {
            output(json_encode($result, JSON_PRETTY_PRINT));
            unset($_SESSION['id']);
            unset($_SESSION['name']);
        }

        break;
}

//helpers

function display($param)
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}

function output($msg)
{
    $_SESSION['Result_from_Model'] = $msg;
    return header("Location: index.php");
}

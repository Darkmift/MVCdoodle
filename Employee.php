<?php
include_once 'Model.php';
class Employee
{
    private $id;
    private $name;
    private $msg;

    public function validateId($num)
    {
        $this->id = $num;
        if (isset($this->id) && is_numeric($this->id)) {
            $_SESSION['id'] = $this->id;
            return true;
        }
        $this->msg .= "please input id<br>";
        return false;
    }

    public function validateName($string)
    {
        $this->name = $string;
        if (strlen($this->name) < 1) {
            $this->msg .= "please input name<br>";
            return false;
        }
        $_SESSION['name'] = $this->name;
        return true;
    }

    public function msg()
    {
        if ($this->msg != "") {
            $_SESSION['Result_from_Model'] = $this->msg;
            return $this->msg;
        }
    }

    public function addToMsg($msgSection)
    {
        $this->msg .= $msgSection;
        return $this->msg;
    }

    public function resetMsg()
    {
        $this->msg = "";
        $_SESSION['Result_from_Model'] = $this->msg;
        return $this->msg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function clearForm()
    {
        unset($_SESSION['id']);
        unset($_SESSION['name']);
    }

    public function runDb($sqlString, $bindArr, $returnType)
    {
        $db = new db();
        $db->query("SELECT * FROM employees WHERE id=:id");
        foreach ($bindArr as $key => $value) {
            $db->bind($key, $value);
        }
        // $db->bind(':id', $_POST['id']);
        $db->execute();
        switch ($returnType) {
            case 'single':
                $result = $db->single();
                break;

            case 'none':
                $result = '';
                break;
        }
        return $result;
    }

    public function runDb2($sqlString, $bindArr, $returnType)
    {
        //die(var_dump($bindArr));
        try {
            $db = new db();
            $db->query($sqlString);
            foreach ($bindArr as $key => $value) {
                $db->bind($key, $value);
            }
            $db->execute();
        } catch (Exception $e) {
            return $e;
        }
        switch ($returnType) {
            case 'single':
                $result = $db->single();
                break;

            case 'none':
                $result = '';
                break;

            case 'rowCount':
                $result = $db->rowCount();
                break;

            case 'resultset':
                $result = $db->resultset();
                break;
        }
        return $result;
    }
}

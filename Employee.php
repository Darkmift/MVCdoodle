<?php

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

    public function clearForm(){
        unset($_SESSION['id']);
        unset($_SESSION['name']);
    }
}

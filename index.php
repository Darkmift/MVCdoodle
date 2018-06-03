<?php
session_start();
//include 'controller.php';
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>BasicMVC</title>
</head>
<body>
<h1 style="margin:2px;">Basic MVC</h1>
<h4 style="padding:0;margin:0;">
This is where you see the output,any requests(like form submit is sent to controller).<br>
nothing is processed here...this page ONLY displays content
</h4>
<hr>
<form action="controller.php" method="POST">
ID:&nbsp;<input style="display: inline;" type="number" name="id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>"/>&nbsp;&nbsp;
Name::&nbsp;<input style="display: inline;" type="text" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>"/>
<br>
<br>
 <input style="display: inline;" type="submit" name="Get Employee" value="Get Employee">
 <input style="display: inline;" type="submit" name="Add New" value="Add New">
 <input style="display: inline;" type="submit" name="Update Employee" value="Update Employee">
 <input style="display: inline;" type="submit" name="Delete Employee" value="Delete Employee">
 <input style="display: inline;" type="submit" name="Get All Employees" value="Get All Employees">
</form>
<hr>
<p>
<?php
if (isset($_SESSION['Result_from_Model'])) {
    // display($_SESSION['Result_from_Model']);
    //unset($_SESSION['Result_from_Model']);
    // echo $_SESSION['Result_from_Model'];
    echo '<pre>' . print_r($_SESSION['Result_from_Model'], true) . '</pre>';
}

?>
</p>
</body>
</html>

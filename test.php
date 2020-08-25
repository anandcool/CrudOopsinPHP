<?php
include "DB.php";
$obj = new query();
$condition = array('name'=>'anand','id'=>1);
$result = $obj->getData('users','name',$condition,'','email','ASC','7');
echo "<pre>";
print_r($result);
?>
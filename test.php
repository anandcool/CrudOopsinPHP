<?php
include "DB.php";
$obj = new query();
// $condition = array('name'=>'anand','id'=>1);
// $condition = array('name'=>'sunny','email'=>'sunny@gmail.com','phone'=>'1234567890');
$condition = array('name'=>'kruzz');
// $result = $obj->getData('users','name',$condition,'','email','ASC','7');
// $result = $obj->insertData('users',$condition);
// echo "<pre>";
// print_r($result);
// $result = $obj->DeleteData('users',$condition);
$result = $obj->UpdateData('users',$condition,'id',1);
?>
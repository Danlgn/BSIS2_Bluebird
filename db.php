<?php

$user = 'root';
$pass = '';
$conn = 'mydb';

$con = mysqli_connect('localhost',$user,$pass,$conn);


if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
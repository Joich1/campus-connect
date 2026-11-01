<?php
include 'config.php';
session_start();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $senha = $_POST['pass'];
};
echo "$username";
echo "$senha";




?>
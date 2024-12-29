<?php
$connect = mysqli_connect('MySQL-8.2', 'root', '', 'crud');

if(!$connect){
    die('Error connect to database!');
}
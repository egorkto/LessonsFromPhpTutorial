<?php

$connect = mysqli_connect('MySQL-8.2', 'root', '', 'registration');

if (! $connect) {
    exit('Error connect to database!');
}

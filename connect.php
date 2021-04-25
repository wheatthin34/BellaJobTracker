<?php
chdir(dirname(__FILE__));
// Connection to live database
// $connection = mysqli_connect('localhost', 'root', 'U6dvtx40FrvG', 'bellaprojects');

// Connection to local database
$connection = mysqli_connect('localhost', 'wheatley', 'password', 'bellaprojects');

if (!$connection){
    die("Database Connection Failed" . mysqli_error());
}
?> 
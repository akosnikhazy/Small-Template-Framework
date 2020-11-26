<?php
/***********************
	Nikházy Ákos

head.php - To autolad classes, form classes folder
***********************/


spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

header("X-Frame-Options: DENY");
?>
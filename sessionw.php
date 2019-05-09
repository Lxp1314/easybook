<?php
session_start();
$_SESSION['abc'] = time();

header('location:sessionr.php');
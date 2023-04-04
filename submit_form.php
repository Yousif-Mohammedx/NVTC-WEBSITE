<?php
session_start();

// Store form data in an array
$ticket = array(
    'id' => uniqid(),
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'nvnumber' => $_POST['nvnumber'],
    'message' => $_POST['message']
);

// Store ticket data in session
$_SESSION['tickets'][] = $ticket;

// Redirect user to done.html
header("Location: done.html");
?>
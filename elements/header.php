<?php
//COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.
$root = $_SERVER["DOCUMENT_ROOT"];
require_once  $root. "/Connexion.class.php";
require_once  $root. "/functions.php";
session_start();
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ma to-do liste </title>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="../style.css">
    </head>
<body>
<a href="../login.php">se connecter</a>
<?php
//require "aside.php";?>
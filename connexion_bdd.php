<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
$user="user";
$pass="user";
try{
    $connexion = new PDO( 'mysql:host=127.0.0.1; dbname=todolist', $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo " pb connexion " . $e->getMessage();
};
?>
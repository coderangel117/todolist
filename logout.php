<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
session_start();
unset($_SESSION['connecte']);
session_destroy();
header("Location: index.php");
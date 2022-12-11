<?php
// COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.
require 'elements/header.php';
var_dump($_SESSION);

if (isset($_POST['save'])){
    if (!empty($_POST['titre'])){
        var_dump($_POST);
        $titre = htmlspecialchars($_POST['titre']);
        $insert = Request('insert into todolist.task (libelle) values (?)', [$titre], "insert");
        var_dump($insert);
    }
}
?>
<body>
<div class="container">
    <div class="header">
        <h1>Todo app</h1>
        <label for="userInput"></label><input type="text" id="userInput" placeholder=" Add a new task" autofocus>
        <button id="enter"><i class="fas fa-plus"></i></button>
    </div>
    <div class="row">
        <div class="tasks-list">
            <ol>
                <!--@TODO changer la liste pour une simple colonne de input pour en faire un formulaire -->
                <!--code in script.js-->
            </ol>
            <!--<button id="AddTask">Ajouter une autre tâche <i class="fas fa-plus"></i></button>-->
        </div>
    </div>
</div>
<form method="POST">
    <label> nom de la liste
        <input id="nameList" name="titre" type="text">
    </label>
    <button id="save" name="save" value="sauvegarder"> enregistrer cette liste</button>
</form>
<div class="test">
    <h1>Vos listes enregistrées </h1>
        <ul>

        </ul>
</div>
</body>
<script type="text/javascript" rel="script" src="script.js"></script>
<!--<script type="text/javascript" rel="script" src="test.js"></script>-->
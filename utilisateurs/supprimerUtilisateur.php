<?php
session_start();
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
require_once  __DIR__ . "/../elements/header.php";
require_once  __DIR__ . "/../functions/auth.php";
Redirect("profil.php","administrateur");
est_connecte();

if (isset($_POST['btnupdateuser'])) {
        $id = $_GET['id'];
        /** @var object $connexion */
        $delete = "DELETE from test_stage.utilisateur where id = $id;";
        Request($delete, [$id], "delete");
        header('Location: index.php');
}?>
<form action="" method="POST">
    <h1 style="text-align: center; color:red;">ATTENTION !! LA SUPRESSION EST DEFINITIVE !!</h1>
        <tr>
            <td>
                <label  class="form-lab" for="id"></label>
            </td>
            <td><input type="hidden" class="form-control" id="id" name="id" value="<?php if (isset($_GET['id'])) {echo $_GET['id'];} ?>"></td>
        </tr>
        <br><br><br>
    <button class="btn" type="submit" value="envoyer" name="btnupdateuser">Envoyer</button>
    <button class="btn"><a href="index.php" class="btn-a">Annuler</a>
    </button>
</form>
<?php require_once __DIR__."/../elements/footer.php";
?>
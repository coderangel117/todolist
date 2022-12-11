<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
require_once "../elements/header.php";
require_once "../functions.php";
$message = "";
if (isset($_POST['button_inscription'])) {
    if (isset($_POST['old_mdp']) and isset($_POST['new_mdp1']) and isset($_POST['new_mdp2'])) {
        $old_mdp = password_hash($_POST['old_mdp'], PASSWORD_BCRYPT );
        $new_mdp1 = password_hash($_POST['new_mdp1'], PASSWORD_BCRYPT );
        $new_mdp2 = password_hash($_POST['new_mdp2'], PASSWORD_BCRYPT );
        if (!empty($_POST['old_mdp'] and $_POST['new_mdp1'] and $_POST['new_mdp2'])) {
            $sql = "select password from test_stage.utilisateur where username = ?";
            $mdp_bdd = Request($sql, [$_SESSION ['username']])->fetchColumn();
            $test_mdp = password_verify($_POST['old_mdp'], $mdp_bdd ); // Compare le mot de passe considéré comme ancien et celui de la base de données
            if ($test_mdp ===true) {
                if ($_POST['new_mdp1'] == $_POST['new_mdp2']) {
                    if ($new_mdp1 !== $old_mdp) {
                        $update ="UPDATE test_stage.utilisateur SET password = ? where username = ?";
                        $update = Request($update,[$new_mdp1, $_SESSION['username']], "update" );
                        header("profil.php");
                        echo $message;
                    } else {
                        $message = " le nouveau mot de passe doit être différent de l'ancien !! ";
                    }
                } else {
                    $message = "vous devez répéter le même mot de passe !! ";
                }
            } else {
                $message = "l'ancien mot de passe n'est pas bon !! ";
            }
        }else{
            $message = "Tous les champs doivent être remplis";
        }
    }
}?>
<form method="POST" action="">
    <table>
        <tr>
            <td>
                <label for="old_mdp">rentrez votre ancien mot de passe</label>
            </td>
            <td>
                <input type="password" name="old_mdp" id="old_mdp">
            </td>
        </tr>
        <tr>
            <td>
                <label for="mdp1">rentrez votre nouveau mot de passe</label>
            </td>
            <td>
                <input type="password" name="new_mdp1" id="new_mdp1">
            </td>
        </tr>
        <tr>
            <td>
                <label for="mdp2">confirmez votre nouveau mot de passe </label>
            </td>
            <td>
                <input type="password" name="new_mdp2" id="new_mdp2">
            </td>
        </tr>
    </table>
    <input type="checkbox" onclick="Afficher()"> Afficher le mot de passe
    <button class="btn" type="submit" value="envoyer" name="button_inscription" id="button_inscription"> Envoyer
    </button>
    <button class="btn"><a href="../profil.php" class="btn-a">Annuler</a></button>
</form>
<script>

    /**
     * Fonction qui permet les mots de passe en remplaçant les caractères cachés par les lettres.
     */
    function Afficher() {
        let input = document.getElementById("old_mdp");
        let input2 = document.getElementById("new_mdp1");
        let input3 = document.getElementById("new_mdp2");
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
        if (input2.type === "password") {
            input2.type = "text";
        } else {
            input2.type = "password";
        }
        if (input3.type === "password") {
            input3.type = "text";
        } else {
            input3.type = "password";
        }
    }
</script>
    <div class="alert">
        <h1 style="color: red;">
            <?= $message; ?>
        </h1>
    </div>
<?php
require_once __DIR__ . "/../elements/footer.php";
?>
<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
session_start();
//require_once __DIR__ . "/elements/header.php";
require_once __DIR__ . "/functions.php";
require_once __DIR__ . "/connexion_bdd.php";

$AffRoles = "SELECT libelle, idRole as id
                        FROM todolist.users, todolist.role
                        WHERE users.role = role.idRole
                         AND role.idrole = ?";
$URoles = Request($AffRoles, [1])->fetch();
Request($AffRoles, [1])->rowcount();

$selectrole = Request("SELECT r.idRole as id, r.libelle as libelle
        from todolist.role r
        where r.libelle not in (SELECT libelle
                        FROM todolist.role r, todolist.users u
                        WHERE u.role = r.idRole
                        AND r.idRole =?)", [1]);
if (isset($_POST['button_inscription'])) {
//    var_dump($_POST);
    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);
    $mdp1 = password_hash($_POST['mdp1'], PASSWORD_BCRYPT);
//    var_dump($mdp1);
    if (!empty($username and $role and $mdp1)) {
        if ($_POST['mdp1'] === $_POST['mdp2']) {
            $parameters = [$username, $mdp1, $role];
            var_dump($parameters);
            try {
                $sql = "INSERT INTO todolist.users (login, password, role) VALUES( ?, ?, ?)";
                $insert = Request($sql, $parameters, "insert");
            } catch (Exception $e) {
                echo 'there is a problem with the select parameters' . $e->getMessage();
            }
            if ($insert) {
                header('Location:index.php');
            } else {
                var_dump($insert);
            }
        } else echo("les mots de passe doivent être les mêmes !! ");
    } else {
        echo("Tous les champs sont obligatoires !! ");
    }
}
?>
<div class="adduser">
    <h1> Ajouter un utilisateur</h1>
    <form method="POST" action="">
        <table>
            <tr>
                <td>
                    <label for="username">username</label>
                </td>
                <td>
                    <input type="text" name="username" id="username" value="<?php if (isset($username)) {
                        echo $username;
                    } ?>">
                </td>
            </tr>
            <tr>

            <tr>
                <td>
                    <label for="role">role</label>
                </td>
                <td>
                    <select class="form-control" name="role" id="role">
                        <option name="default" value="<?= $URoles['id']; ?>">
                            <?= $URoles['libelle']; ?>
                        </option>
                        <?php foreach ($selectrole as $role) { ?>
                            <option selected value="<?php if (isset($role['id'])) {
                                echo $role['id'];
                            } ?>" id="role" name="role">
                                <?= $role['libelle']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mdp1">rentrez votre mot de passe</label>
                </td>
                <td>
                    <input type="password" name="mdp1" id="mdp1">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mdp2">confirmez votre mot de passe </label>
                </td>
                <td>
                    <input type="password" name="mdp2" id="mdp2">
                </td>
            </tr>
        </table>
        <button class="btn" type="submit" value="envoyer" name="button_inscription" id="button_inscription">Envoyer
        </button>
        <button class="btn"><a href="utilisateurs/index.php" class="btn-a">Annuler</a></button>
        <!--    --><?php //if (isset($_POST['button_inscription']) and $_POST['button_inscription']) {
        //        header('Location: index.php');
        //    } ?>
    </form>
</div>

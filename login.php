<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
require_once __DIR__ . "/elements/header.php";
require_once "connexion_bdd.php";
require_once 'functions.php';
if (isset($_POST['formconnexion'])) {
    if (!empty($_POST['login']) and !empty($_POST['mdpconnect'])) {
        $login = htmlspecialchars($_POST['login']);
        $sql = $connexion->prepare("select password from users where login = ?");
        $sql->execute(array($_POST['login']));
        $mdp_bdd = $sql->fetchcolumn();
        $mdpconnect = $_POST['mdpconnect'];
        $testmdp = password_verify($mdpconnect, $mdp_bdd);
        if ($testmdp === true) {
            $requser = $connexion->prepare("SELECT login, libelle as role
            FROM users u, todolist.role r
            where  login = ? AND password = ?
            and r.idRole = u.role");
            $requser->execute(array($login, $mdp_bdd));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                session_start();
                $userinfo = $requser->fetch();
                $_SESSION['username'] = $userinfo['login'];
                $_SESSION['role'] = $userinfo['role'];
                $_SESSION['connecte'] = 1;
                if ($_SESSION['role'] == "administrateur") {
                    header("Location: admin/index.php");
                } else {
                    header("Location: ./index.php");
                }
            }
        } else {
            $message = "Mauvais login ou mot de passe !";
        }
    } else {
        $message = "Tous les champs doivent être complétés !";
    }
}?>

    <div class="main">
        <div class="container-login">
            <div class="login-content">
                <h2>Connexion</h2>
                <br/><br/>
                <form class="form-login" method="POST" action="">
                    <div><label for="login">votre username
                        </label>
                    </div>
                    <div>
                        <input type="text" name="login" placeholder="login"/>
                    </div>
                    <div><label for="mdpconnect">votre mot de passe</label></div>
                    <div><input type="password" name="mdpconnect" placeholder="Mot de passe"/></div>
                    <div><input type="submit" name="formconnexion" value="Se connecter "/></div>
                </form>
                <?php
                if (isset($message)) {
                    echo '<h1 style="color:red;">' . $message . "</h1>";
                }
                ?>
            </div>
        </div>
    </div>
<?php require_once __DIR__ . "/elements/footer.php";
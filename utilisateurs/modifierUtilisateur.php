<?php
session_start();
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
require_once  __DIR__ . "/../elements/header.php";
require_once  __DIR__ . "/../functions.php";
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "select id from metalheads.utilisateur";
    $select_id = Request($sql, [])->fetchAll();
    $array_id = array_column($select_id, 'id');
    $exists = in_array($id, $array_id);
    if ($exists != false) {
        $sqlrole = "SELECT libelle, idRole as id
                 FROM metalheads.utilisateur u, metalheads.role r
                 WHERE u.role = r.idRole
                 AND u.id = ? ";
    $idparcours = Request($sqlrole, [$id])->fetch();
    $sqloption = "SELECT r.idRole as id, r.libelle
        from metalheads.role r
        where r.libelle !=  (SELECT libelle
                        FROM metalheads.role r, metalheads.utilisateur u
                        WHERE u.role = r.idRole
                        AND u.id = $id)";
        $selectrole = Request($sqloption,[]);
    }
    else{
        header('location: index.php');
    }
}
else{
    header('location: index.php');
}
if (isset($_POST['btnupdateuser'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);
    if (!empty($prenom and $nom and $username and $role)) {
            $id = $_GET['id'];
            $parameters = [ $nom,$prenom , $role, $username, $id ];
            $sql = "UPDATE metalheads.utilisateur SET nom = ?, prenom = ?, role = ?,  username = ? where id= ?";
            $insert = Request($sql,$parameters,"update" );
            header('Location: index.php');
    } else {
        echo "tous les champs doivent completes";
    }
}
?>
<form action="" method="POST">
    <table>
        <?php
            $id = $_GET['id'];
            $sql = "SELECT id, role, username , password from metalheads.utilisateur where id = ? order by id ";
            $users = Request($sql, [$id]);
        foreach ($users as $user): //  Pour chaque ligne renvoyée par la requete afficher le tableau suivant?>
            <tr>
                <th>champs</th>
                <th>new valeur</th>
            </tr>
            <tr>
                <td><label for="username">le username</label></td>
                <td><input type="text" class="form-control"  name="username" id="username" value="<?php if (isset($user['username'])) {echo $user['username'];} ?>"></td>
            </tr>
            <tr>
                <td><label for="role">le role</label></td>
                <td>
                    <select class="form-control" name="role" id="role">
                        <option name="defaul" selected value="<?= $idparcours['id'];?>" selected>
                            <?= $idparcours['libelle'];?>
                        </option>
                        <?php foreach ($selectrole as $role) { ?>
                            <option value="<?php if(isset($role['id'])){ echo $role['id'];}?>"  id="select-trajet" name="select-trajet">
                                <?= $role['libelle'] ;?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        <?php endforeach?>
    </table>
    <button class="btn" type="submit" value="envoyer" name="btnupdateuser">Envoyer</button>
    <button class="btn"><a href="index.php" class="btn-a">Annuler</a></button>
</form>
<?php require_once __DIR__."/../elements/footer.php";
?>
<?php
/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/
require_once __DIR__ . "/../elements/header.php";
require_once __DIR__ . "/../functions.php";
session_start();
var_dump($_SESSION);
echo $_SESSION == [] ? "<a href=../login.php>connexion</a>" : "<a href=../logout.php>déconnexion</a>";
/**
 * Requête pour récupérer les utilisateurs en affichant correctement le rôle de chacun
 */
$sql = "SELECT id, libelle as role, username from metalheads.utilisateur, metalheads.role
WHERE role.idRole = utilisateur.role
order by libelle, id ";

$users = Request($sql, []);
?>

<table class="users">
	<caption>Tableau de données</caption>
	<th>id</th>
    <th> username </th>
    <?php
    if($_SESSION['role'] == "administrateur") {?>
	    <th> role </th>
    <?php } ?><br>
    <a href="../inscription.php">nouveau</a>
	<?php foreach ($users as $user) { ?>
		<tr>
			<td><?= $user['id']; ?></td>
            <td><?= $user['username']; ?></td>
            <?php
            if($_SESSION['role'] == "administrateur") {?>
                <td><?= $user['role'];?></td> <?php
            }
            ?>

			<td>
                <button class="btn"><a class="btn-a" href ="supprimerUtilisateur.php?id=<?php echo($user['id']); ?>" ><img alt="supprimer la reservation" src="https://img.icons8.com/ios-glyphs/30/000000/trash--v1.png"/></a></button>
            </td>
			<td>
                <button class="btn"><a class="btn-a"  id="UpdateItem" href ="modifierUtilisateur.php?id=<?php echo($user['id']); ?>"> <img alt="modifer la reservation" src="https://img.icons8.com/ios-glyphs/30/000000/border-color.png"/> </a></button>
            </td>
		</tr>
		<br>

	<?php } ?>
</table>
<?php require_once __DIR__."/../elements/footer.php";
?>
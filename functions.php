/*COPYRIGHT (C)  todolist ( Gabriel PERINO) 2019. All rights reserved.*/

<?php
require_once __DIR__ . '/Connexion.class.php';
/**
 * @param $sql // represents the SQL query
 * @param array $parameters // represents the parameters of the query if exist
 * @param string $type // represents the type of SQL query among the 4 propositions : select /update / insert / delete
 * @return bool|PDOStatement|void
 */
function Request($sql, $parameters, string $type = "select")
{
    $connexion_admin = new Connexion("root", "");
    $connexion = $connexion_admin->getConnexion();
    if ($type !== "select") {
        try {
            $requete = $connexion->prepare($sql);
        } catch (Exception $e) {
            return 'there is a problem' . $e->getMessage();
        }
        return $requete->execute($parameters);
    } else {
        if ($parameters == []) {
            return $connexion->query($sql);
        } else {
            try {
                $requete = $connexion->prepare($sql);
                $requete->execute($parameters);
                return $requete;
            } catch (Exception $e) {
                return 'there is a problem with the select parameters' . $e->getMessage();
            }
        }
    }
}

/**
 *  Fonction de <b>redirection</b> vers *$redirect* .<br>Si session <b>INEXISTANTE</b> ou <b>VIDE</b>
 * ou si le role est<b> DIFFERENT </b> du paramètre *$role*
 * Le paramètre *$role* est optionnel, s'il n'est pas rentré, l'utilisateur n'est redirigé que s'il n'a pas de session active (déconnecté)
 * @param string $redirect
 * @param mixed $role
 * @return void
 * @author Gabriel PERINO <gabriel@gmail.com>
 */

function Redirect(string $redirect, $role = false)
{
    if (isset($_SESSION) && !empty($_SESSION)) {
        if ($role !== false) {
            if ($_SESSION['role'] !== $role) {
                header('Location:' . $redirect);
            }
        }
    } else {
        header('Location: ../index.php');
    }
}


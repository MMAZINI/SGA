<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:15
 */

session_start();
if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('location:login.php');
}
$logado = $_SESSION['login'];
?>
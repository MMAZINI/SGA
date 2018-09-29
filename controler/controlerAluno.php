<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "dao/alunoDAO.php";
require_once "classes/aluno.php";

$template = new Template();
$object = new alunoDAO();

$template->header();
$template->sidebar();
$template->navbar();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $matricula = (isset($_POST["matricula"]) && $_POST["matricula"] != null) ? $_POST["matricula"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $matricula = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $aluno = new aluno($id, '', '');

    $resultado = $object->atualizar($aluno);
    $nome = $resultado->getNome();
    $matricula = $resultado->getMatricula();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $matricula != "") {
    $aluno = new aluno($id, $matricula, $nome);
    $msg = $object->salvar($aluno);
    $id = null;
    $nome = null;
    $matricula = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $aluno = new aluno($id, '', '');
    $msg = $object->remover($aluno);
    $id = null;
}

?>
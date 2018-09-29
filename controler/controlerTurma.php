<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:20
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $disciplina = (isset($_POST["disciplina"]) && $_POST["disciplina"] != null) ? $_POST["disciplina"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $disciplina = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $turma = new turma($id, '','');

    $resultado = $object->atualizar($turma);
    $nome = $resultado->getNome();
    $disciplina = $resultado->getDisciplina();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    $turma = new turma($id, $disciplina, $nome);
    $msg =$object->salvar($turma);
    $id = null;
    $nome = null;
    $disciplina = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $turma = new turma($id, '', '');
    $msg = $object->remover($turma);
    $id = null;
}

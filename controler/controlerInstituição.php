<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:05
 */


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $sigla = (isset($_POST["sigla"]) && $_POST["sigla"] != null) ? $_POST["sigla"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $sigla = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $instituicao = new instituicao($id, '', '');

    $resultado = $object->atualizar($instituicao);
    $nome = $resultado->getNome();
    $sigla = $resultado->getSigla();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    $instituicao = new instituicao($id, $nome, $sigla);
    $msg = $object->salvar($instituicao);
    $id = null;
    $nome = null;
    $sigla = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $instituicao = new instituicao($id, '', '');
    $msg = $object->remover($instituicao);
    $id = null;
}


?>
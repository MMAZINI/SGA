<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:00
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $professor = (isset($_POST["professor"]) && $_POST["professor"] != null) ? $_POST["professor"] : "";
    $sigla = (isset($_POST["sigla"]) && $_POST["sigla"] != null) ? $_POST["sigla"] : "";
    $cargaHoraria = (isset($_POST["cargaHoraria"]) && $_POST["cargaHoraria"] != null) ? $_POST["cargaHoraria"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $professor = NULL;
    $sigla = null;
    $cargaHoraria = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $disciplina = new disciplina($id, '','','','');
    $resultado = $object->atualizar($disciplina);
    $nome = $resultado->getNome();
    $professor = $resultado->getProfessor();
    $sigla = $resultado->getSigla();
    $cargaHoraria = $resultado->getCargaHoraria();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    $disciplina = new disciplina($id, $professor, $nome, $sigla, $cargaHoraria);
    $msg = $object->salvar($disciplina);
    $id = null;
    $nome = null;
    $professor = null;
    $sigla = null;
    $cargaHoraria = null;
}
?>
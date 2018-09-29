

<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 19:56
 */
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $instituicao = (isset($_POST["instituicao"]) && $_POST["instituicao"] != null) ? $_POST["instituicao"] : "";
    $sigla = (isset($_POST["sigla"]) && $_POST["sigla"] != null) ? $_POST["sigla"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $instituicao = NULL;
    $sigla = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $curso = new curso($id, '', '', '');
    $resultado = $object->atualizar($curso);
    $nome = $resultado->getNome();
    $instituicao = $resultado->getInstituicao();
    $sigla = $resultado->getSigla();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    $curso = new curso($id, $instituicao, $nome, $sigla);
    $msg = $object->salvar($curso);
    $id = null;
    $nome = null;
    $instituicao = null;
    $sigla = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $curso = new curso($id, '', '', '');
    $msg = $object->remover($curso);
    $id = null;
}
?>
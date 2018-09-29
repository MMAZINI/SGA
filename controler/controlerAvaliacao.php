<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 21:45
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $Curso_idCurso = (isset($_POST["Curso_idCurso"]) && $_POST["Curso_idCurso"] != null) ? $_POST["Curso_idCurso"] : "";
    $Turma_idTurma = (isset($_POST["Turma_idTurma"]) && $_POST["Turma_idTurma"] != null) ? $_POST["Turma_idTurma"] : "";
    $Aluno_idAluno = (isset($_POST["Aluno_idAluno"]) && $_POST["Aluno_idAluno"] != null) ? $_POST["Aluno_idAluno"] : "";
    $Nota1 = (isset($_POST["Nota1"]) && $_POST["Nota1"] != null) ? $_POST["Nota1"] : "";
    $Nota2 = (isset($_POST["Nota2"]) && $_POST["Nota2"] != null) ? $_POST["Nota2"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $Curso_idCurso = null;
    $Turma_idTurma = null;
    $Aluno_idAluno = null;
    $Nota1 = null;
    $Nota2 = null;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $avaliacao = new avaliacao($id, '','','','');
    $resultado = $object->atualizar($avaliacao);
    $Curso_idCurso= $resultado->getCurso_idCurso();
    $Turma_idTurma = $resultado->getTurma_idTurma();
    $Aluno_idAluno= $resultado->getAluno_idAluno();
    $Nota1 = null= $resultado->getNota1();
    $Nota2 = null= $resultado->getNota2();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    $disciplina = new disciplina($id, $Curso_idCurso, $Turma_idTurma, $Aluno_idAluno, $Nota1, $Nota2 );
    $msg = $object->salvar($avaliacao);
    $id = null;
    $Curso_idCurso = null;
    $Turma_idTurma = null;
    $Aluno_idAluno = null;
    $Nota1 = null;
    $Nota2 = null;

}
?>



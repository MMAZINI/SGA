<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 21:00
 */

class Avaliacao
{
   private $idAvaliação;
   private $Curso_idCurso;
   private $Turma_idTurma;
   private $Aluno_idAluno;
   private $Nota1;
   private $Nota2;
   Private $NotFinal;

    /**
     * Avaliacao constructor.
     * @param $Curso_idCurso
     * @param $Turma_idTurma
     * @param $Aluno_idAluno
     * @param $Nota1
     * @param $Nota2
     * @param $NotFinal
     */
    public function __construct($Curso_idCurso, $Turma_idTurma, $Aluno_idAluno, $Nota1, $Nota2, $NotFinal)
    {
        $this->Curso_idCurso = $Curso_idCurso;
        $this->Turma_idTurma = $Turma_idTurma;
        $this->Aluno_idAluno = $Aluno_idAluno;
        $this->Nota1 = $Nota1;
        $this->Nota2 = $Nota2;
        $this->NotFinal = $NotFinal;
    }

    /**
     * @return mixed

     */
    public function Avaliar($Nota1, $Nota2,$notafinal){

      $soma =$Nota1 +$Nota2;
      $media = $soma / 2;
      if($media >=7){

          echo" APROVADO";
      }
      else if($media<4){
          echo"REPROVADO";
      }
      else if(($media)+$notafinal)2 >= 6){
         echo"APROVADO";

        }
    }


    public function getIdAvaliação()
    {
        return $this->idAvaliação;
    }

    /**
     * @param mixed $idAvaliação
     */
    public function setIdAvaliação($idAvaliação)
    {
        $this->idAvaliação = $idAvaliação;
    }

    /**
     * @return mixed
     */
    public function getCursoIdCurso()
    {
        return $this->Curso_idCurso;
    }

    /**
     * @param mixed $Curso_idCurso
     */
    public function setCursoIdCurso($Curso_idCurso)
    {
        $this->Curso_idCurso = $Curso_idCurso;
    }

    /**
     * @return mixed
     */
    public function getTurmaIdTurma()
    {
        return $this->Turma_idTurma;
    }

    /**
     * @param mixed $Turma_idTurma
     */
    public function setTurmaIdTurma($Turma_idTurma)
    {
        $this->Turma_idTurma = $Turma_idTurma;
    }

    /**
     * @return mixed
     */
    public function getAlunoIdAluno()
    {
        return $this->Aluno_idAluno;
    }

    /**
     * @param mixed $Aluno_idAluno
     */
    public function setAlunoIdAluno($Aluno_idAluno)
    {
        $this->Aluno_idAluno = $Aluno_idAluno;
    }

    /**
     * @return mixed
     */
    public function getNota1()
    {
        return $this->Nota1;
    }

    /**
     * @param mixed $Nota1
     */
    public function setNota1($Nota1)
    {
        $this->Nota1 = $Nota1;
    }

    /**
     * @return mixed
     */
    public function getNota2()
    {
        return $this->Nota2;
    }

    /**
     * @param mixed $Nota2
     */
    public function setNota2($Nota2)
    {
        $this->Nota2 = $Nota2;
    }

    /**
     * @return mixed
     */
    public function getNotFinal()
    {
        return $this->NotFinal;
    }

    /**
     * @param mixed $NotFinal
     */
    public function setNotFinal($NotFinal)
    {
        $this->NotFinal = $NotFinal;
    }




}



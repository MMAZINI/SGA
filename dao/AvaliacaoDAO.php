<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 21:09
 */
require_once "db/conexao.php";
require_once "classes/Avaliacao.php";
class AvaliacaoDAO
{

    public function remover($avaliacao)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM avaliacao WHERE idAvaliacao = :id");
            $statement->bindValue(":id", $avaliacao->getIdAvalicao());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($avaliacao)
    {
        global $pdo;
        try {
            if ($avaliacao->getIdAvaliação() != "") {
                $statement = $pdo->prepare("UPDATE avaliacao SET Curso_idCurso = :Curso_IdCurso, Turma_idTurma=:Turma_idTurma, Aluno_idAluno=:Aluno_idAluno, Nota1 = :Nota1, Nota2= :Nota2;  WHERE idAvaliação = :id;");
                $statement->bindValue(":id", $avaliacao->getIdAluno());
            } else {
                $statement = $pdo->prepare("INSERT INTO Avaliacao (Curso_idCurso, Turma_idTurma, Aluno_idAluno, Nota1,Nota2) VALUES (:Curso_IdCurso,:Turma_idTurma,:Aluno_idAluno,:Nota1, :Nota2 )");
            }
            $statement->bindValue(":Curso_idCurso", $avaliacao->getCurso_idCurso());
            $statement->bindValue(":matricula", $avaliacao->getTurma_idTurma());
            $statement->bindValue(":matricula", $avaliacao->getTurma_idTurma());
            $statement->bindValue(":matricula", $avaliacao->getAluno_idAluno());
            $statement->bindValue(":matricula", $avaliacao->getNota1());
            $statement->bindValue(":matricula", $avaliacao->getNota2());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($Avaliacao)
    {

        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT Curso_idCurso, Turma_idTurma, Aluno_idAluno, Nota1, Nota2  FROM avaliacao WHERE idAvaliacao = :id");
            $statement->bindValue(":id", $Avaliacao->getIdAvaliacao());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $Avaliacao->setCurso_idCurso($rs->Curso_idCurso);
                $Avaliacao->setTurma_idTurma($rs->Turma_idTurma);
                $Avaliacao->setAluno_idAluno($rs->Aluno_idAluno);
                $Avaliacao->setNota1($rs->Nota1);
                $Avaliacao->setNota2($rs->Nota2);
                return $Avaliacao;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 2);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT idAvaliacao,Curso_idCurso, Turma_idTurma, Aluno_idAluno, Nota1, Nota2 FROM Avaliacao LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM Avaliacao";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>idAvaliacao</th>
        <th>Curso_idCurso</th>
        <th>Turma_idTurma</th>
        <th>Aluno_idAluno</th>
        <th>Nota1</th>
        <th>Nota2</th>
        
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $var):
                echo "<tr>
        <td>$var->idAvaliacao</td>
        <td>$var->Curso_idCurso</td>
        <td>$var->Turma_idTurma</td>
        <td>$var->Aluno_idAluno</td>
        <td>$var->Nota1</td>
        <td>$var->Nota2</td>
        
        <td><a href='?act=upd&id=$var->idAvaliacao'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$var->idAvaliacao'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
       <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }



}
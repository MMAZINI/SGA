<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 28/09/2018
 * Time: 20:09
 */
require_once "db/conexao.php";
class logarDAO
{
    public function logar()
    {
        session_start();
        $login = $_POST['usuario'];
        $passwd = $_POST['senha'];

        try {

            global $pdo;
            $statement = $pdo->prepare("SELECT Usuario, Senha, Nome FROM Usuario WHERE Usuario = :login and Senha = :senha");
            $statement->bindValue(":login", $login);
            $statement->bindValue(":senha", sha1($passwd));
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $usuario = $rs->Usuario;
                $nome = $rs->Nome;
                $senha = $rs->Senha;
                if ($usuario != null and $senha != null) {
                    $_SESSION['login'] = $nome;
                    $_SESSION['senha'] = $senha;
                    header('location:index.php');
                } else {
                    unset ($_SESSION['login']);
                    unset ($_SESSION['senha']);
                    header('location:index.php');

                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
}




<?php
require_once 'Data/Contexto.php';
require_once 'Models/Professor.php';

class ProfessorApp
{
    private $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function getAll()
    {
        $conexao = $this->db->getConn();

        $sql = "SELECT * FROM professor ORDER BY id DESC";
        $sql = $conexao->prepare($sql);
        $sql->execute();

        $professores = array();

        while ($row = $sql->fetchObject('Professor')) {
            $professores[] = $row;
        }

        if (!$professores) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        }

        return $professores;
    }

    public function add(Professor $professor)
    {
        if (empty($professor->nome)) {
            throw new Exception("Nome é obrigatório");

            return false;
        }

        $conexao = $this->db->getConn();

        $sql = 'INSERT INTO professor (nome, registro, titulacao, sexo)
                VALUES (:nome, :registro, :titulacao, :sexo)';

        $sql = $conexao->prepare($sql);

        $result = $sql->execute(array(
            ':nome' => $professor->nome,
            ':registro' => $professor->registro,
            ':titulacao' => $professor->titulacao,
            ':sexo' => $professor->sexo
        ));

        if ($result == 0) {
            throw new Exception("Falha ao inserir deletar");
        }

        return true;
    }

    public function getById($id)
    {
        $conexao = $this->db->getConn();

        $sql = "SELECT * FROM professor where id = :id";
        $sql = $conexao->prepare($sql);
        $sql->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $sql->execute();

        $result = $sql->fetchObject('Professor');

        if (!$result) {
            throw new Exception('Não foi encontrado nenhum registro no banco');
        } else {
            // $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }

        return $result;
    }

    public function edit(Professor $professor)
    {
        $connection = $this->db->getConn();

        $sql = "UPDATE professor set nome = :nome, registro = :registro,
             sexo = :sexo, titulacao = :titulacao WHERE id = :id";

        $sql = $connection->prepare($sql);

        $result = $sql->execute(array(
            ':id' => $professor->id,
            ':nome' => $professor->nome,
            ':registro' => $professor->professor,
            ':sexo' => $professor->sexo,
            ':titulacao' => $professor->titulacao
        ));

        if ($result == 0) {
            throw new Exception("Erro ao editar professor");
        }
    }

    public function delete($id)
    {
        $conexao = $this->db->getConn();

        $sql = 'DELETE FROM professor WHERE id = :id';

        $sql = $conexao->prepare($sql);

        $erro = $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        $result = $sql->execute(array(':id' => (int) $id));

        if ($result == 0)
            throw new Exception($erro);

        return true;
    }
}

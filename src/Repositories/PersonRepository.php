<?php

namespace PersonalFinance\Repositories;

use Exception;
use PDO;
use PDOStatement;
use PersonalFinance\Constants\Messages;
use PersonalFinance\database\ConnectionSqlite;

class PersonRepository extends ConnectionSqlite
{
    private const TABLE = 'PERSONS';

    /**
     * @var ConnectionSqlite
     */
    private $conexao;

    public function __construct()
    {
        $this->conexao = $this->conectar();
    }

    /**
     * @return false|PDOStatement
     */
    public function getAll()
    {
        return $this->conexao->query("SELECT * FROM " . self::TABLE)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id)
    {
        return $this->conexao->query("SELECT * FROM " . self::TABLE . " WHERE ID = " . $id)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $person
     * @return bool
     * @throws Exception
     */
    public function insert(array $person): bool
    {
        $fields = array_keys($person);
        $values = array_values($person);
        $parameters = array_pad([], count($fields), '?');

        $sql = "INSERT INTO " . self::TABLE . "(" . implode(',', $fields) . ") VALUES (" .
            implode(',', $parameters) . ")";

        $statement = $this->conexao->prepare($sql);
        $statement->bindValue('NOME_COMPLETO', $person['NOME_COMPLETO'], PDO::PARAM_STR_CHAR);

        $response = $statement->execute();

        if ($response) {
            return $response;
        }

        throw new Exception(Messages::MESSAGE_CREATE_ERROR);
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE ID = " . $id;
        $statement = $this->conexao->prepare($sql);
        $response = $statement->execute();

        if ($response) {
            return $response;
        }

        throw new Exception(Messages::MESSAGE_DELETE_ERROR);
    }
}

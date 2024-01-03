<?php

namespace PersonalFinance\repositories;

use PDOStatement;
use PersonalFinance\database\ConnectionSqlite;

class PersonRepository extends ConnectionSqlite
{
    private const TABLE = 'persons';

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
        $stmp = $this->conexao->query('SELECT * FROM PERSONS');
        return $stmp->execute();
    }
}

<?php

namespace PersonalFinance\Database;

use Exception;
use PDO;

class ConnectionSqlite
{
    /**
     * @var PDO
     */
    private $conexao;
    private $filePath = __DIR__;
    private $filename = 'personal_finance.sqlite';
    private $dsn = 'sqlite:';
    private $username = 'username';
    private $password = 'password';


    public function conectar()
    {
        try {
            $this->conexao = new PDO(
                $this->dsn.$this->filePath.DIRECTORY_SEPARATOR . $this->filename,
                $this->username,
                $this->password
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexao;
        } catch (Exception $exception) {
            echo json_encode(
                [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ]
            );
        }
    }
}

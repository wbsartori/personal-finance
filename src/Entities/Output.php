<?php

namespace PersonalFinance\Entities;

class Output
{
    private $id = 0;
    private $descricao = '';
    private $tipo = '';
    private $valor = 0;
    private $data_entrada = '';
    private $pessoa_id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return int
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param int $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return string
     */
    public function getDataEntrada()
    {
        return $this->data_entrada;
    }

    /**
     * @param string $data_entrada
     */
    public function setDataEntrada($data_entrada)
    {
        $this->data_entrada = $data_entrada;
    }

    /**
     * @return mixed
     */
    public function getPessoaId()
    {
        return $this->pessoa_id;
    }

    /**
     * @param mixed $pessoa_id
     */
    public function setPessoaId($pessoa_id)
    {
        $this->pessoa_id = $pessoa_id;
    }
}

<?php

namespace PersonalFinance\Controllers;

use PersonalFinance\Core\AbstractController;

class OutputController extends AbstractController
{
    public function index()
    {
        $this->views('outputs.index', ['title' => 'OutputController', 'text' => 'Movimentações']);
    }
}

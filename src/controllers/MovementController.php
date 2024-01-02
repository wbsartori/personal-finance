<?php

namespace PersonalFinance\Controllers;

use PersonalFinance\Core\AbstractController;

class MovementController extends AbstractController
{
    public function index()
    {
        $this->views('movements.index', ['title' => 'MovementController', 'text' => 'Movimentações']);
    }
}

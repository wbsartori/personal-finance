<?php

namespace PersonalFinance\Controllers;

use PersonalFinance\Core\AbstractController;

class EntryController extends AbstractController
{
    public function index()
    {
        $this->views('entries.index', ['title' => 'EntradasController', 'text' => 'Entradas']);
    }
}

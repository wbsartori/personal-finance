<?php

namespace PersonalFinance\Controllers;

use PersonalFinance\Core\AbstractController;

class PersonController extends AbstractController
{
    public function index()
    {
        $this->views('persons.index', ['title' => 'PersonController', 'text' => 'Pessoas']);
    }
}

<?php

namespace PersonalFinance\Core;

class AbstractController
{
    protected $views;

    public function __construct()
    {
        $this->views = require dirname(dirname(__DIR__)) . '/config/views.php';
    }

    public function views(string $page, array $data)
    {
        echo $this->views->make($page, $data)->render();
    }
}

<?php

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Opdrachten periode 4'
        ];

        $this->view('home/index', $data);
    }
}
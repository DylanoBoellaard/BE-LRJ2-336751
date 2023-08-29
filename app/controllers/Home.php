<?php

class Home extends BaseController
{
    public function index($id = NULL, $naam = NULL)
    {
        $data = [
            'title' => 'Welkom op de homepage',
            'id'    => $id,
            'naam'  => $naam
        ];

        $this->view('home/index', $data);
    }
}
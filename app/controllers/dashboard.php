<?php

class dashboard extends BaseController
{

    public function index()
    {
       
        $data = [
            'title' => 'Dashboard',
        ];

    
        $this->view('dashboard/index', $data);
    }

     public function start()
    {
        $data = [
            'title' => 'Start',
        ];

    
        $this->view('dashboard/start', $data);
    }

}
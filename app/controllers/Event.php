<?php

class Event extends BaseController
{
    private $Event;

    public function __construct()
    {
        $this->Event = $this->model('EventModel');
    }


    public function index()
    {
        try {
        $result = $this->Event->GetAllContactPersonen();
        
        $data = [
            'title' => 'Overzicht Event',
            'Event' => $result
        ];

        $this->view('Eventpage/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
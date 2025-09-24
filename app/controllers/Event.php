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
        $result = $this->Event->getAllEvent();
        
        $data = [
            'title' => 'Overzicht Event',
            'Event' => $result
        ];

        $this->view('Event/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
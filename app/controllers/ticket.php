<?php

class ticket extends BaseController
{

    public function index($firstname = NULL, $infix = NULL, $lastname = NULL)
    {
        /**
         * Het $data-array geeft informatie mee aan de view-pagina
         */


        $data = [
            'title' => 'Ticket overzicht',
        ];

        /**
         * Met de view-method uit de BaseController-class wordt de view
         * aangeroepen met de informatie uit het $data-array
         */
        $this->view('ticket/index', $data);
    }

    /**
     * De optellen-method berekent de som van twee getallen
     * We gebruiken deze method voor een unittest
     */
}
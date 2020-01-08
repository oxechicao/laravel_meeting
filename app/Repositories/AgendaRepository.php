<?php


namespace App\Repositories;


use App\Agenda;

class AgendaRepository
{
    private $agenda;

    public function __construct()
    {
        $this->agenda = new Agenda();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function allByUser($id)
    {
        return $this->agenda->where('user_id', $id)->get();
    }
}

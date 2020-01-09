<?php


namespace App\Repositories;


use App\Agenda;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function insert(array $data)
    {
        if (isset($data['participants']) && is_array($data['participants'])) $data['participants'] = json_encode($data['participants']);

        $data['date'] = Carbon::create($data['date'])
            ->setHour(explode(':', $data['hour'])[0])
            ->setMinute(explode(':', $data['hour'])[1])
            ->setSeconds(0)
            ->setMilliseconds(0);


        $data['user_id'] = \Auth::user()->id;
        $data['created_at'] = Carbon::now('America/Fortaleza');
        $data['updated_at'] = Carbon::now('America/Fortaleza');

        return DB::table('agendas')->insert([$data]);
    }
}

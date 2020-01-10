<?php


namespace App\Repositories;


use App\Agenda;
use App\Trais\AgendaTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgendaRepository
{
    use AgendaTrait;

    /**
     * @param $id
     * @return mixed
     */
    public function allByUser($id)
    {
        return Agenda::where('user_id', $id)->orderBy('date', 'desc')->get();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        $data = $this->defineParticipants($data);
        $data = $this->defineDate($data);

        $data['user_id'] = \Auth::user()->id;
        $data['created_at'] = Carbon::now('America/Fortaleza');
        $data['updated_at'] = Carbon::now('America/Fortaleza');

        return DB::table('agendas')->insert([$data]);
    }

    /**
     * @param array $data
     * @param Agenda $agenda
     * @return bool
     */
    public function update(array $data, Agenda $agenda)
    {
        $data = $this->defineDate($data);
        return $agenda->update($data);
    }
}

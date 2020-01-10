<?php


namespace App\Trais;


use Carbon\Carbon;

trait AgendaTrait
{
    /**
     * Define data to be saved as datetime
     *
     * @param array $data
     * @return array
     */
    public function defineDate(array $data)
    {
        $data['date'] = Carbon::create($data['date'])
            ->setHour(explode(':', $data['hour'])[0])
            ->setMinute(explode(':', $data['hour'])[1])
            ->setSeconds(0)
            ->setMilliseconds(0);
        return $data;
    }

    public function defineParticipants($data)
    {
        if (isset($data['participants']) && is_array($data['participants'])) {
            $data['participants'] = json_encode($data['participants'], true);
        }
        return $data;
    }
}

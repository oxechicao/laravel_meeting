<?php


namespace App\Repositories;


use App\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
    /**
     * @var Contact
     */
    private $contact;

    /**
     * ContactRepository constructor.
     */
    public function __construct()

    {
        $this->contact = new Contact();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getContactsByUserId($id)
    {
        return Contact::where('user_id', $id)
            ->select(['id', 'name', 'email', 'phones'])
            ->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        if (isset($data['phones']) && is_array($data['phones'])) $data['phones'] = json_encode($data['phones']);
        $data['user_id'] = \Auth::user()->id;
        $data['created_at'] = Carbon::now('America/Fortaleza');
        $data['updated_at'] = Carbon::now('America/Fortaleza');
        return DB::table('contacts')->insert([$data]);
    }

    public function update($data)
    {
        return Contact::where('id', $data['id'])->update($data);
    }
}

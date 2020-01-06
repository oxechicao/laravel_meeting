<?php


namespace App\Repositories;


use App\Contact;

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
}

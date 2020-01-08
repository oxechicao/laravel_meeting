<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ContactRepository $contactRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ContactRepository $contactRepository)
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, ContactRepository $contactRepository)
    {
        $this->validator($request->all())->validate();
        return response()->json($contactRepository->insert($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contact $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Contact $contact, ContactRepository $contactRepository)
    {
        $this->validator($request->all())->validate();
        return response()->json($contactRepository->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contact $contact
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Contact $contact)
    {
        return response()->json($contact->delete());
    }

    public function getAll(ContactRepository $contactRepository)
    {
        return response()->json($contactRepository->getContactsByUserId(\Auth::user()->id));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
    }
}

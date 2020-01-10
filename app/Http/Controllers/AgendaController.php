<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Repositories\AgendaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('agenda/index', [
            'actions' => collect([
                'store' => route('agenda.store'),
                'update' => route('agenda.update'),
                'destroy' => route('agenda.destroy'),
                'getAllContacts' => route('contact.all'),
                'storeContact' => route('contact.store'),
                'destroyContact' => route('contact.destroy'),
                'updateContact' => route('contact.update'),
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param AgendaRepository $agendaRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, AgendaRepository $agendaRepository)
    {
        $this->validator($request->all())->validate();
        return response()->json($agendaRepository->insert($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Agenda $agenda
     * @param AgendaRepository $agendaRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Agenda $agenda, AgendaRepository $agendaRepository)
    {
        $this->validator($request->all())->validate();
        return response()->json($agendaRepository->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Agenda $agenda
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Agenda $agenda)
    {
        return response()->json($agenda->delete());
    }

    /**
     * @param AgendaRepository $agendaRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(AgendaRepository $agendaRepository)
    {
        return response()->json($agendaRepository->allByUser(\Auth::user()->id));
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'date' => ['required', 'date'],
            'hour' => ['required', 'string'],
            'participants' => ['required', 'array']
        ]);
    }
}

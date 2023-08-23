<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\EditClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with(['task', 'project'])->paginate(20);
        return view('layouts.clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')->withMessage('Client has been created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('layouts.clients.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('layouts.clients.edit')->with('client',$client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditClientRequest $request, string $id)
    {

        try {
            $client = Client::findOrFail($id);

            $client->update($request->validated());
        } catch (ModelNotFoundException $exception) {


            return redirect()->route('clients.create')->withErrors($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index')->withMessage('Client has been deleted succefully');
    }

    public function sofDelete(Client $client)
    {

        $client->delete_at = now();
        $client->save();
    }
}

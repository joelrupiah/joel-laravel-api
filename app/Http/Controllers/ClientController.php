<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'clients' => $clients
        ], 200);
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required'
        ]);

        $slug = slugify($request->name);

        Client::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return response()->json('Client created successfully', 200);
    }

    public function show(Client $client)
    {
        //
    }

    public function update(Request $request, Client $client, $id)
    {
        // return $request;
        $request->validate([
            'name' => 'required'
        ]);

        $client = Client::findOrFail($id);
        // return $client;
        $client->name = $request->name;
        $client->save();

        return response()->json('Client updated', 200);
    }

    public function destroy(Client $client, $id)
    {
        $client = Client::find($id, 'id');
        // return $client;
        $client->delete();

        return response()->json('Client deleted', 200);
    }
}

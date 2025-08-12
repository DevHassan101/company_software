<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('name', 'DESC')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3',
            'company_name' => 'required|min:5',
            'email' => 'required',
            'phone' => 'required',
            'whatsapp' => 'required',
            'profile' => 'required|image',
            'about' => 'required',
            'reference' => 'required'
        ]);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/clients/profile', $name_gen);
            $validation['profile'] = 'uploads/clients/profile/' . $name_gen;
        }

        Client::create($validation);

        return redirect()->route('client.index')->with('message', 'Client Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $client = Client::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required|min:3',
            'company_name' => 'required|min:5',
            'email' => 'required',
            'phone' => 'required',
            'whatsapp' => 'required',
            'profile' => 'nullable|image',
            'about' => 'required',
            'reference' => 'required'
        ]);

        if ($request->hasFile('profile')) {

            if ($client->profile && file_exists(public_path($client->profile))) {
                unlink(public_path($client->profile));
            }

            $image = $request->file('profile');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/clients/profile', $name_gen);
            $validation['profile'] = 'uploads/clients/profile/' . $name_gen;
        }

        $client->update($validation);

        // dd($client);
        // return view('clients.index');
        return redirect()->route('client.index')->with('message', 'Client Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('client.index')->with('message', 'Client Deleted Successfully');
    }
}

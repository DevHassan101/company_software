<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::orderBy('name', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $html = view('pages.clients.table', compact('clients'))->render();
            $records = $clients;
            $pagination = view('pages.appends.pagination', compact('records'))->render();
            return response()->json([
                'error' => false,
                'html' => $html,
                'pagination' => $pagination
            ]);
        }
        return view('pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3',
            'company_name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'whatsapp' => 'nullable',
            'profile' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'nullable',
            'reference' => 'nullable',
            'category' => 'required'
        ]);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/clients/profile', $name_gen);
            $validation['profile'] = 'uploads/clients/profile/' . $name_gen;
        }

        Client::create($validation);

        return redirect()->route('client.index')->with('success', 'Client Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('projects');
        // return $client;
        return view('pages.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);

        return view('pages.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $client = Client::findOrFail($id);

        $validation = $request->validate([
            'name' => 'required|min:3',
            'company_name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'whatsapp' => 'nullable',
            'profile' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about' => 'nullable',
            'reference' => 'nullable',
            'category' => 'required'
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
        return redirect()->route('client.index')->with('success', 'Client Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client Deleted Successfully');
    }
}

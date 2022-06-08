<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(Client::query()->withCount('companies'))->make(true);
        }

        return view('admin.clients.index');
    }

    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(CreateClientRequest $request)
    {
        $client = Client::create($request->validated());

        $client->companies()->sync($request->get('companies', []));

        return redirect(route('admin.clients.index'))->withSuccess('Client was added');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        $client->companies()->sync($request->get('companies', []));

        return redirect(route('admin.clients.index'))->withSuccess('Client was updated');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['status' => 200]);
    }

}

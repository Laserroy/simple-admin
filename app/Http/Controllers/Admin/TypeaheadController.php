<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeaheadController extends Controller
{
    public function companies(Request $request)
    {
        $companies = Company::where('name', 'LIKE', "%$request->search%")->simplePaginate(20);

        return response()->json($companies);
    }

    public function clients(Request $request)
    {
        $clients = Client::where(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%$request->search%")->simplePaginate(20);

        return response()->json($clients);
    }
}

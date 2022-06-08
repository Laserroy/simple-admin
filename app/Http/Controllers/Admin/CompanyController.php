<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(Company::query()->withCount('clients'))->make(true);
        }

        return view('admin.companies.index');
    }

    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        $company->clients()->sync($request->get('clients', []));

        return redirect(route('admin.companies.index'))->withSuccess('Company was created');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        $company->clients()->sync($request->get('clients', []));

        return redirect(route('admin.companies.index'))->withSuccess('Company was updated');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json(['status' => 200]);
    }
}

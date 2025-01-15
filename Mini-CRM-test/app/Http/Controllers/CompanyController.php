<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Mail\CompanyRegistered;

class CompanyController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$companies = Company::paginate(env('ROWS_PER_PAGE',10));
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {

        try {
            $data = $request->validated();

            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $company = Company::create($data);
            Mail::to(env('ADMIN_MAIL_ADDRESS', 'admin@admin.com'))->send(new CompanyRegistered($company));

            return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Failed to create company: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function showById(string $id)
    {
        //
        return view('companies.show', compact('company'));
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editById(string $id)
    {
        //
        return view('companies.edit', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateById(Request $request, string $id)
    {
        //
    }

    public function update(StoreCompanyRequest $request, Company $company)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('logo')) {
                if ($company->logo) {
                    Storage::disk('public')->delete($company->logo);
                }
                $data['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $company->update($data);
            return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Failed to update company: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyById(string $id)
    {
        //
  //      try {
            $intId = filter_var($id, FILTER_VALIDATE_INT);
            $company = Company::where('id', $intId)->first();
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
   //     }
    }

    public function destroy(Company $company)
    {
        try {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Failed to delete company: ' . $e->getMessage());
        }
    }
}

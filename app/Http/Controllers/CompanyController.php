<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('company.list-companies',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        try {
            $valid = $request->validated();
            if($request->hasFile('logo')) {
                $valid['logo'] = $request->file('logo')->store('logos','public');
            }
            $company = new Company($valid);
            $company->save();
            if(!$company->wasRecentlyCreated) {
                return Redirect::back()->withErrors(['errors' => 'Error creating the logo']);
            }
            return Redirect::route('companies.index')->with('success','Company '.$company->name.' created');
        } catch(\Exception $e) {
            Log::error('error when saving a new company '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error trying to save a company']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('company.view-company',compact('company'));
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Unknown Company']);
        } catch(\Exception $e) {
            Log::error('error viewing a company '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error trying to view company']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $company = Company::findOrFail($id);
            return view('company.edit-company',compact('company'));
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Unknown Company']);
        } catch(\Exception $e) {
            Log::error('error viewing a company '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error trying to view company']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        try {
            $company = Company::findOrFail($id);
            $valid = $request->validated();
            if($request->hasFile('logo')) {
                $valid['logo'] = $request->file('logo')->store('logos','public');
            }
            $company->fill($valid);
            $company->save();
            return Redirect::route('companies.index')->with('success','Company '.$company->name.' updated');
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Company not found']);
        } catch(\Exception $e) {
            Log::error('error deleting company '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error deleting company']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->delete();
            return Redirect::route('companies.index')->with('success','Company Deleted');
        } catch(ModelNotFoundException $e) {
            return Redirect::back()->withErrors(['errors' => 'Company not found']);
        } catch(\Exception $e) {
            Log::error('error deleting company '.$e->getMessage());
            return Redirect::back()->withErrors(['errors' => 'Error deleting company']);
        }
    }
}

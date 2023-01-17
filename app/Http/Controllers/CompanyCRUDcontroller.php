<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCRUDcontroller extends Controller
{
    //Create index
    public function index() {
        $data['companies'] = Company::orderBy('id','asc')->paginate(5);
        return view('companies.index', $data);
    }

    //Create resource
    public function create() {
        return view('companies.create');
    }

    //Store resource
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'address' => 'required'
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;

        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been created successfully');
    }

    //Edit
    public function edit(Company $company) {
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'address' => 'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address; 

        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been updated successfully');
    }

    //Destroy
    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been deleted successfully');
    }
}

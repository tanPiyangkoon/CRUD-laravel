<?php

namespace App\Http\Controllers;

use App\models\Company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{
    // Create Index
    public function index() {
        $data['companies'] = Company::orderBy('id', 'asc')->paginate(5);
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
            'email' => 'required',
            'address' =>'required'
        ]);
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been created success fully. !'); # รีไดเร็กกลับไปหน้า Index เพื่อดูว่าข้อมูลถูกเพิ่มเข้ามาหรือยัง ถ้าเพิ่มเเล้วต้องเเสดงมาที่หน้าindex
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success', 'Company has been updated successfully .');
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been deleted successfully .');
    }
}



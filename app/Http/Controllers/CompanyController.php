<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function update($id){
        Company::findOrFail($id)->update([
            'tools_note' => request('tools_note')
        ]);

        return response()->json(request('tools_note'));
    }
}

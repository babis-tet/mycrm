<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
         return view('company.company');
    }

}

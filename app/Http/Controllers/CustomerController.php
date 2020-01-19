<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        return response()->json($customer, 200);
    }

    public function edit(Customer $customer)
    {
        return redirect()->back();
    }

    public function update(Request $request, Customer $customer)
    {
        return redirect()->back();
    }

    public function destroy(Customer $customer)
    {
        return redirect()->back();
    }
}

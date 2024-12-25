<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomersBoat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerBoatController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole(['Admin', 'Manager'])) {
            $customer_boats = CustomersBoat::all();
        }else{
            $customer_boats = Auth::user()->boats;
        }
        return view('admin.customer_boats.index', compact('customer_boats'));
    }

    public function create()
    {
        if (Auth::user()->hasRole('Admin')) {
            $users = User::role('Customer')->get();
        }else{
            $users = User::where('id',Auth::user()->id)->get();
        }
        return view('admin.customer_boats.create',compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        // Create the customer
        CustomersBoat::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('customer_boats.index')->with('success', 'Customer Boat created successfully!');
    }

    public function edit(CustomersBoat $customerBoat)
    {
        if (Auth::user()->hasRole('Admin')) {
            $users = User::role('Customer')->get();
        }else{
            $users = User::where('id',Auth::user()->id)->get();
        }
        return view('admin.customer_boats.edit', compact('customerBoat','users'));
    }

    public function update(Request $request, CustomersBoat $customerBoat)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        // Update the customer's information
        $customerBoat->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('customer_boats.index')->with('success', 'Customer Boat updated successfully!');
    }

    public function destroy(CustomersBoat $customerBoat)
    {
        // Delete the customer from the database
        $customerBoat->delete();

        return redirect()->route('customer_boats.index')->with('success', 'Customer Boat deleted successfully!');
    }
}

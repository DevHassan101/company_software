<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Expense::with('users')->paginate(10);
        return view('pages.salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('pages.salaries.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'paid_for' => 'required',
            'receipt' => 'nullable',
            'description' => 'nullable|string',
        ]);


        $validation['added_by'] = auth()->id();
        $validation['type'] = 'salary';
        $receipt = [];

        if ($request->has('receipt')) {
            foreach ($request->file('receipt') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/salary/receipt', $name_gen);
                $receipt[] = 'uploads/salary/receipt/' . $name_gen;
            }

            $validation['receipt'] = json_encode($receipt);
        }

        Expense::create($validation);

        return redirect()->route('salary.index')->with('success', 'Salary Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $salary)
    {   
        return view('pages.salaries.view', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $salary)
    {
        $users = User::all();
        return view('pages.salaries.edit', compact('salary', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $salary)
    {
        $validation = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'paid_for' => 'required',
            'receipt' => 'nullable',
            'description' => 'nullable|string',
        ]);

        $validation['added_by'] = auth()->id();
        $validation['type'] = 'salary';

        if ($request->hasFile('receipt')) {
            foreach ($request->file('receipt') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/salary/receipt', $name_gen);
                $receipt[] = 'uploads/salary/receipt/' . $name_gen;
            }

            $validation['receipt'] = json_encode($receipt);
        } else {
            $validation['receipt'] = $salary->receipt;
        }

        $salary->update($validation);

        return redirect()->route('salary.index')->with('success', 'Salary Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $salary)
    {
        $salary->delete();

        return redirect()->route('salary.index')->with('success', 'Salary Deleted Successfully');
    }
}

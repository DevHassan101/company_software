<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('user')->orderBy('type', 'desc')->paginate(10);
        return view('pages.expenses.index', compact('expenses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'amount' => 'required|integer',
            'receipt' => 'nullable',
            'description' => 'nullable|string',
            'type' => 'required'
        ]);

        $validation['added_by'] = auth()->id();

        $receipt = [];

        if ($request->has('receipt')) {
            foreach ($request->file('receipt') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/receipt/receipt', $name_gen);
                $receipt[] = 'uploads/receipt/receipt/' . $name_gen;
            }
        }

        $validation['receipt'] = json_encode($receipt);

        Expense::create($validation);

        return redirect()->route('expense.index')
            ->with('message', 'Expense Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return view('pages.expenses.view', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('pages.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validation = $request->validate([
            'amount' => 'nullable|integer',
            'receipt' => 'nullable',
            'description' => 'nullable|string',
            'user_id' => 'nullable',
            'type' => 'nullable'
        ]);
        $validation['added_by'] = auth()->id();

        $receipt = [];

        if ($request->hasFile('receipt')) {
            foreach ($request->file('receipt') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/receipt/receipt', $name_gen);
                $receipt[] = 'uploads/receipt/receipt/' . $name_gen;
            }

            $validation['receipt'] = json_encode($receipt);
        } else {
            $validation['receipt'] = $expense->receipt;
        }

        $expense->update($validation);

        return redirect()->route('expense.index')->with('message', 'Expense Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')
            ->with('message', 'Expense Deleted Successfully');
    }
}

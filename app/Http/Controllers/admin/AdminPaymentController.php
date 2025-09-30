<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPayment;

class AdminPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = ProjectPayment::with('project')->latest()->paginate(10);
        return view('admin.pages.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('admin.pages.payments.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'project_id' => 'required',
            'amount' => 'required|integer',
            'note' => 'nullable',
            'media'   => 'nullable|array',
            'media.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validation['created_by'] = auth()->id();

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/payment', $name_gen);
                $mediaPaths[] = 'uploads/project/payment/' . $name_gen;
            }
        }

        $validation['media'] = json_encode($mediaPaths);

        ProjectPayment::create($validation);

        return redirect()->route('admin.payment.index')->with('success', 'Payment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectPayment $payment)
    {
        // return $payment;
        return view('admin.pages.payments.view', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectPayment $payment)
    {
        $projects = Project::all();
        return view('admin.pages.payments.edit', compact('payment', 'projects'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectPayment $payment)
    {

        $validation = $request->validate([
            'project_id' => 'required',
            'amount' => 'required',
            'note' => 'nullable',
            'media'   => 'nullable|array',
            'media.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validation['created_by'] = auth()->id();

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/project/payment', $name_gen);
                $mediaPaths[] = 'uploads/project/payment/' . $name_gen;
            }

            $validation['media'] = json_encode($mediaPaths);
        } else {
            $validation['media'] = $payment->media;
        }

        $payment->update($validation);

        return redirect()->route('admin.payment.index')->with('success', 'Payment Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectPayment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payment.index')->with('success', 'Payment Deleted Successfully');
    }
}

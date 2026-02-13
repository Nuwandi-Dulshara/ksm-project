<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // ✅ IMPORTANT (Fixes your error)
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        $categories = ExpenseCategory::all();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created expense.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'         => 'required|date',
            'title'        => 'required|string|max:255',
            'expense_type' => 'required|string',
            'amount'       => 'required|numeric|min:0',
            'status'       => 'required|string',
            'paid_to'      => 'nullable|string|max:255',
            'receipt'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle Receipt Upload
        if ($request->hasFile('receipt')) {
            $validated['receipt'] = $request->file('receipt')
                ->store('receipts', 'public');
        }

        Expense::create($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Created Successfully!');
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified expense.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'date'         => 'required|date',
            'title'        => 'required|string|max:255',
            'expense_type' => 'required|string',
            'amount'       => 'required|numeric|min:0',
            'status'       => 'required|string',
            'paid_to'      => 'nullable|string|max:255',
            'receipt'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // If new receipt uploaded
        if ($request->hasFile('receipt')) {

            // Delete old receipt if exists
            if ($expense->receipt && Storage::disk('public')->exists($expense->receipt)) {
                Storage::disk('public')->delete($expense->receipt);
            }

            $validated['receipt'] = $request->file('receipt')
                ->store('receipts', 'public');
        }

        $expense->update($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Updated Successfully!');
    }

    /**
     * Remove the specified expense.
     */
    public function destroy(Expense $expense)
    {
        // Delete receipt file if exists
        if ($expense->receipt && Storage::disk('public')->exists($expense->receipt)) {
            Storage::disk('public')->delete($expense->receipt);
        }

        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense Deleted Successfully!');
    }
}

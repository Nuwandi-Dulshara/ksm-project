<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Donator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Income::with('donator');

        // Month Filter
        if ($request->month) {
            $query->whereMonth('received_date', date('m', strtotime($request->month)))
                ->whereYear('received_date', date('Y', strtotime($request->month)));
        }

        // Search Filter
        if ($request->search) {
            $query->whereHas('donator', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhere('invoice_number', 'like', '%' . $request->search . '%');
        }

        $incomes = $query->latest()->paginate(10);

        $currentMonthTotal = Income::whereMonth('received_date', now()->month)
                                ->whereYear('received_date', now()->year)
                                ->sum('amount');

        $lastMonthTotal = Income::whereMonth('received_date', now()->subMonth()->month)
                                ->whereYear('received_date', now()->subMonth()->year)
                                ->sum('amount');

        $donators = Donator::all();

        return view('incomes.index', compact(
            'incomes',
            'currentMonthTotal',
            'lastMonthTotal',
            'donators'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'donator_id' => 'required|exists:donators,id',
            'amount' => 'required|numeric',
            'received_date' => 'required|date',
        ]);

        // Auto Generate Invoice Number
        $year = date('Y');

        $lastIncome = Income::whereYear('created_at', $year)
                            ->orderBy('id', 'desc')
                            ->first();

        if ($lastIncome) {
            $lastNumber = intval(substr($lastIncome->invoice_number, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $invoiceNumber = "INV-$year-$newNumber";

        $data = $request->all();
        $data['invoice_number'] = $invoiceNumber;

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                                        ->store('income_attachments', 'public');
        }

        Income::create($data);

        return redirect()->route('incomes.index')
                        ->with('success', 'Income recorded successfully.');
    }


    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()->route('incomes.index')
            ->with('success', 'Income deleted successfully.');
    }

    public function edit(Income $income)
    {
        $donators = Donator::all();

        return view('incomes.edit', compact('income', 'donators'));
    }
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'donator_id' => 'required|exists:donators,id',
            'amount' => 'required|numeric',
            'received_date' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {

            // delete old file
            if ($income->attachment) {
                \Storage::disk('public')->delete($income->attachment);
            }

            $data['attachment'] = $request->file('attachment')
                                        ->store('income_attachments', 'public');
        }

        $income->update($data);

        return redirect()->route('incomes.index')
                        ->with('success', 'Income updated successfully.');
    }


}

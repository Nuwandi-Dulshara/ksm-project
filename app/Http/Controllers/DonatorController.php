<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorController extends Controller
{
public function index(Request $request)
{
    $query = Donator::query();

    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    $donators = $query->latest()->paginate(10);

    return view('donators.index', compact('donators'));
}


    public function create()
    {
        return view('donators.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Donator::create($request->all());

        return redirect()->route('donators.index')
                         ->with('success', 'Donator registered successfully.');
    }

    public function edit(Donator $donator)
    {
        return view('donators.edit', compact('donator'));
    }

    public function update(Request $request, Donator $donator)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
        ]);

        $donator->update($request->all());

        return redirect()->route('donators.index')
                         ->with('success', 'Donator updated successfully.');
    }

    public function destroy(Donator $donator)
    {
        $donator->delete();

        return redirect()->route('donators.index')
                         ->with('success', 'Donator deleted successfully.');
    }
}

@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f8f9fa; }

    .btn-add-income {
        background-color: #1853f5;
        color: white;
        font-weight: bold;
        border: none;
    }

    .btn-add-income:hover {
        background-color: #072e9b;
        color: white;
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Expence category</h2>
            <p class="text-muted mb-0">Track all incoming payments and invoices.</p>
        </div>

        <a href="{{ route('expense-categories.create') }}"
           class="btn btn-add-income btn-lg shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Add Expense Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-list me-2 text-muted"></i>
            New Expense Category
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Index No:</th>
                        <th>Expense Type</th>
                        <th>Category</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $category->expense_type }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td class="text-end pe-4">

                                <a href="{{ route('expense-categories.edit', $category->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('expense-categories.destroy', $category->id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                No Expense Categories Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

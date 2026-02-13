@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f8f9fa; }

    .btn-add-expense {
        background-color: #1853f5;
        color: white;
        font-weight: bold;
        border: none;
    }

    .btn-add-expense:hover {
        background-color: #072e9b;
        color: white;
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Expense Registration</h2>
            <p class="text-muted mb-0">Manage all recorded company expenses.</p>
        </div>

        <a href="{{ route('expenses.create') }}"
           class="btn btn-add-expense btn-lg shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Add Expense
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-receipt me-2 text-muted"></i>
            Expense List
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($expenses as $index => $expense)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}
                            </td>

                            <td class="fw-bold">
                                {{ $expense->title }}
                            </td>

                            <td class="text-capitalize">
                                {{ $expense->expense_type }}
                            </td>

                            <td class="fw-bold text-dark">
                                ${{ number_format($expense->amount, 2) }}
                            </td>

                            <td>
                                @if($expense->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>

                            <td class="text-end pe-4">

                                {{-- View Receipt --}}
                                @if($expense->receipt)
                                    <a href="{{ asset('storage/'.$expense->receipt) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-success"
                                       title="View Receipt">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endif

                                {{-- Edit --}}
                                <a href="{{ route('expenses.edit',$expense->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('expenses.destroy',$expense->id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this expense?')"
                                            title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No Expenses Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection

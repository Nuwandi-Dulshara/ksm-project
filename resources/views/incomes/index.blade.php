@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Income Management</h2>
            <p class="text-muted mb-0">Track all incoming payments and invoices.</p>
        </div>

        <button class="btn btn-success btn-lg shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#addIncomeModal">
            <i class="fa-solid fa-plus me-2"></i> Record New Income
        </button>
    </div>

    {{-- Summary --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted small mb-1">Total Income (This Month)</p>
                <h3 class="fw-bold text-success mb-0">
                    LKR {{ number_format($currentMonthTotal, 2) }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted small mb-1">Last Month</p>
                <h3 class="fw-bold text-dark mb-0">
                    LKR {{ number_format($lastMonthTotal, 2) }}
                </h3>
            </div>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <form method="GET" action="{{ route('incomes.index') }}">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="month"
                               name="month"
                               value="{{ request('month') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-5">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Search by client or invoice number...">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-list me-2 text-muted"></i>
            Transaction History
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Source / Client</th>
                        <th>Invoice #</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($incomes as $income)
                        <tr>
                            <td class="ps-4">
                                {{ \Carbon\Carbon::parse($income->received_date)->format('M d, Y') }}
                            </td>

                            <td class="fw-bold">
                                {{ $income->donator->name }}
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $income->invoice_number ?? 'INV-' . date('Y') . '-' . str_pad($income->id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <td>
                                {{ $income->description }}
                            </td>

                            <td class="text-success fw-bold">
                                +{{ number_format($income->amount, 2) }}
                            </td>

                            <td class="text-end pe-4">

                                {{-- View PDF --}}
                                @if($income->attachment)
                                    <a href="{{ asset('storage/' . $income->attachment) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-light border"
                                       title="View Invoice">
                                        <i class="fa-solid fa-file-pdf text-danger"></i>
                                    </a>
                                @endif

                                {{-- Edit --}}
                                <a href="{{ route('incomes.edit', $income) }}"
                                   class="btn btn-sm btn-outline-warning me-2 fw-bold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('incomes.destroy', $income) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger fw-bold"
                                            onclick="return confirm('Delete this income record?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center text-muted py-4">
                                No income records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 d-flex justify-content-end">
            {{ $incomes->withQueryString()->links() }}
        </div>

    </div>

</div>

{{-- ADD INCOME MODAL --}}
<div class="modal fade" id="addIncomeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('incomes.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-circle-plus me-2"></i>
                        Record Income
                    </h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Donator</label>
                        <select name="donator_id"
                                class="form-control"
                                required>
                            <option value="">Select Donator</option>
                            @foreach($donators as $donator)
                                <option value="{{ $donator->id }}">
                                    {{ $donator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount</label>
                        <input type="number"
                               name="amount"
                               step="0.01"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Invoice Number</label>
                        <input type="text"
                            class="form-control"
                            value="Auto Generated (INV-{{ date('Y') }}-XXX)"
                            disabled>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Date Received</label>
                        <input type="date"
                               name="received_date"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Attachment</label>
                        <input type="file"
                               name="attachment"
                               class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success fw-bold">
                        Save Record
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

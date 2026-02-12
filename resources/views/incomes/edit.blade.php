@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Edit Income</h2>
            <p class="text-muted mb-0">Update income information.</p>
        </div>

        <a href="{{ route('incomes.index') }}"
           class="btn btn-secondary fw-bold px-4">
            <i class="fa-solid fa-arrow-left me-2"></i> Back
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-pen-to-square me-2 text-muted"></i>
            Income Information
        </div>

        <div class="card-body p-4">

            <form action="{{ route('incomes.update', $income) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="row g-3">

                @csrf
                @method('PUT')

                {{-- Donator --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Donator</label>
                    <select name="donator_id"
                            class="form-control"
                            required>
                        @foreach($donators as $donator)
                            <option value="{{ $donator->id }}"
                                {{ $income->donator_id == $donator->id ? 'selected' : '' }}>
                                {{ $donator->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Amount --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Amount</label>
                    <input type="number"
                           name="amount"
                           step="0.01"
                           class="form-control"
                           value="{{ old('amount', $income->amount) }}"
                           required>
                </div>

                {{-- Invoice Number (Read Only) --}}
                <div class="col-md-6">
                    <label class="form-label">Invoice Number</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $income->invoice_number }}"
                           disabled>
                </div>

                {{-- Date --}}
                <div class="col-md-6">
                    <label class="form-label">Date Received</label>
                    <input type="date"
                           name="received_date"
                           class="form-control"
                           value="{{ old('received_date', $income->received_date) }}"
                           required>
                </div>

                {{-- Description --}}
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="3">{{ old('description', $income->description) }}</textarea>
                </div>

                {{-- Attachment --}}
                <div class="col-md-6">
                    <label class="form-label">Replace Attachment</label>
                    <input type="file"
                           name="attachment"
                           class="form-control">
                </div>

                {{-- View Existing Attachment --}}
                @if($income->attachment)
                <div class="col-md-6 d-flex align-items-end">
                    <a href="{{ asset('storage/' . $income->attachment) }}"
                       target="_blank"
                       class="btn btn-outline-danger">
                        <i class="fa-solid fa-file-pdf me-2"></i>
                        View Current Attachment
                    </a>
                </div>
                @endif

                {{-- Submit --}}
                <div class="col-12 text-end mt-4">
                    <button class="btn btn-success fw-bold px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Update Income
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection

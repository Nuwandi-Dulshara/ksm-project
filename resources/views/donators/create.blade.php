@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f8f9fa; }

    .form-section-title {
        font-size: 0.85rem;
        font-weight: bold;
        text-transform: uppercase;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 5px;
        margin-bottom: 15px;
        margin-top: 20px;
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('donators.index') }}"
           class="btn btn-outline-secondary me-3 rounded-circle"
           style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <h2 class="fw-bold text-dark mb-0">Register New Donator</h2>
            <p class="text-muted mb-0">
                Add a new charity contributor to the system.
            </p>
        </div>
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

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <form action="{{ route('donators.store') }}" method="POST">
                @csrf

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        {{-- Donator Information --}}
                        <div class="form-section-title">
                            Donator Information
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       placeholder="e.g. Ahmed Kareem"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       value="{{ old('phone') }}"
                                       placeholder="+94 ...">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small">
                                    Email Address
                                </label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email') }}"
                                       placeholder="email@example.com">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small">
                                    Address
                                </label>
                                <textarea name="address"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Enter full address...">{{ old('address') }}</textarea>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('donators.index') }}"
                               class="btn btn-light border">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary fw-bold px-4">
                                <i class="fa-solid fa-save me-2"></i>
                                Save Donator
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

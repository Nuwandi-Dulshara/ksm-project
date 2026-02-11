@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f8f9fa; }

    .card-hover {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.08);
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Edit Donator</h2>
            <p class="text-muted mb-0">Update donator information.</p>
        </div>

        <a href="{{ route('donators.index') }}"
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

    {{-- Form Card --}}
    <div class="card shadow-sm border-0 card-hover">

        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-user-pen me-2 text-muted"></i>
            Donator Information
        </div>

        <div class="card-body">

            <form action="{{ route('donators.update', $donator) }}"
                  method="POST"
                  class="row g-3">

                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $donator->name) }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $donator->email) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone', $donator->phone) }}">
                </div>

                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="address"
                              class="form-control"
                              rows="3">{{ old('address', $donator->address) }}</textarea>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-primary fw-bold px-4">
                        <i class="fa-solid fa-save me-2"></i> Update Donator
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

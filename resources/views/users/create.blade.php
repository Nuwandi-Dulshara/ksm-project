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
            <h2 class="fw-bold text-dark mb-1">Create New User</h2>
            <p class="text-muted mb-0">Add a new system user.</p>
        </div>

        <a href="{{ route('users.index') }}"
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
            <i class="fa-solid fa-user-plus me-2 text-muted"></i>
            User Information
        </div>

        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Enter full name"
                           required>
                </div>

                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Enter email address"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           value="{{ old('username') }}"
                           placeholder="Enter username"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter password"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-primary fw-bold px-4">
                        <i class="fa-solid fa-save me-2"></i> Save User
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

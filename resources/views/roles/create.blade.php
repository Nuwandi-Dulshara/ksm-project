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
    <div class="d-flex align-items-left mb-4">
        <a href="{{ route('roles.index') }}"
           class="btn btn-outline-secondary me-3 rounded-circle"
           style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-dark mb-0">Add New Role</h2>
            <p class="text-muted mb-0">
                Create a role to control system access and permissions.
            </p>
        </div>
    </div>

    {{-- Form --}}
    <div class="row">
    <div class="col-12">

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        {{-- Role Information --}}
                        <div class="form-section-title">Role Information</div>

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
                                    Role Name
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="e.g. Accountant, HR Manager"
                                       required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small">
                                    Role Description
                                </label>
                                <textarea name="description"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Describe what this role can access or manage..."></textarea>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('roles.index') }}"
                               class="btn btn-light border">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary fw-bold px-4">
                                <i class="fa-solid fa-save me-2"></i>
                                Save Role
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

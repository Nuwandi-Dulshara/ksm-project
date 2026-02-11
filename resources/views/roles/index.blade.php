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

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Role Management</h2>
            <p class="text-muted mb-0">
                Manage system roles and access levels.
            </p>
        </div>

        <a href="{{ route('roles.create') }}"
           class="btn btn-primary fw-bold px-4">
            <i class="fa-solid fa-plus me-2"></i> Add New Role
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Roles Table Card --}}
    <div class="card shadow-sm border-0 card-hover">
        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-layer-group me-2 text-muted"></i>
            All Roles
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($roles as $role)
                        <tr>
                            <td class="ps-4 fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                {{ $role->name }}
                            </td>

                            <td class="text-muted">
                                {{ $role->description ?? '—' }}
                            </td>

                            <td class="text-end pe-4">
                                <a href="{{ route('roles.edit', $role) }}"
                                   class="btn btn-sm btn-outline-warning me-2 fw-bold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('roles.destroy', $role) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger fw-bold"
                                            onclick="return confirm('Delete this role?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center text-muted py-4">
                                No roles found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

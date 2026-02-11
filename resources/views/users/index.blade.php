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

    .password-text {
        letter-spacing: 2px;
    }

    .toggle-eye {
        cursor: pointer;
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">User Management</h2>
            <p class="text-muted mb-0">
                Manage system users and access roles.
            </p>
        </div>

        <a href="{{ route('users.create') }}"
           class="btn btn-primary fw-bold px-4">
            <i class="fa-solid fa-plus me-2"></i> Add New User
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Users Table Card --}}
    <div class="card shadow-sm border-0 card-hover">

        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-user me-2 text-muted"></i>
            All Users
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold">
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                {{ $user->name }}
                            </td>

                            <td class="text-muted">
                                {{ $user->email }}
                            </td>

                            <td>
                                {{ $user->username }}
                            </td>

                            <td>
                                @if($user->role)
                                    <span class="badge bg-primary">
                                        {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        No Role
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span id="password-{{ $user->id }}" 
                                      class="password-text">
                                    ••••••••
                                </span>

                                <i class="fa-solid fa-eye ms-2 toggle-eye"
                                   onclick="togglePassword({{ $user->id }}, '{{ $user->password }}')">
                                </i>
                            </td>

                            <td class="text-end pe-4">

                                <a href="{{ route('users.edit', $user) }}"
                                   class="btn btn-sm btn-outline-warning me-2 fw-bold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger fw-bold"
                                            onclick="return confirm('Delete this user?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7"
                                class="text-center text-muted py-4">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white d-flex justify-content-end">
            {{ $users->links() }}
        </div>

    </div>

</div>


<script>
function togglePassword(userId, hashedPassword) {

    let passwordField = document.getElementById('password-' + userId);

    if (passwordField.innerText === '••••••••') {
        passwordField.innerText = hashedPassword;
    } else {
        passwordField.innerText = '••••••••';
    }
}
</script>

@endsection

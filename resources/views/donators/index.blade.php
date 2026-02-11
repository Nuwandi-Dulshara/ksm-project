@extends('layouts.app')

@section('content')

<style>
    body { background-color: #f8f9fa; }

    .category-card {
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        border: none;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
</style>

<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark">Donator Directory</h2>
            <p class="text-muted mb-0">
                Manage all registered charity donators.
            </p>
        </div>

        <a href="{{ route('donators.create') }}"
           class="btn btn-primary fw-bold px-4">
            <i class="fa-solid fa-plus me-2"></i> Add New Donator
        </a>
    </div>

    {{-- Summary Card --}}
    <div class="row justify-content-center mb-5">
        <div class="col-md-5">
            <div class="card category-card shadow-sm p-4 text-center">

                <div class="d-flex justify-content-center">
                    <div class="icon-box bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                </div>

                <h3 class="fw-bold text-dark">
                    {{ $donators->total() }}
                </h3>

                <p class="text-muted">
                    Total Registered Donators
                </p>

            </div>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search Filter --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('donators.index') }}">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Search by name or email...">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100 fw-bold">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Donators Table --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3 fw-bold">
            <i class="fa-solid fa-list me-2 text-muted"></i>
            All Donators
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($donators as $donator)
                        <tr>
                            <td class="ps-4 fw-bold">
                                {{ $donator->name }}
                            </td>

                            <td>
                                {{ $donator->email }}
                            </td>

                            <td>
                                {{ $donator->phone }}
                            </td>

                            <td class="text-end pe-4">

                                {{-- Edit --}}
                                <a href="{{ route('donators.edit', $donator) }}"
                                   class="btn btn-sm btn-outline-warning me-2 fw-bold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('donators.destroy', $donator) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger fw-bold"
                                            onclick="return confirm('Delete this donator?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center text-muted py-4">
                                No donators found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-3 d-flex justify-content-end">
            {{ $donators->withQueryString()->links() }}
        </div>

    </div>

</div>

@endsection

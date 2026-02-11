@extends('layouts.app')

@push('styles')
<style>
    .card-metric {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .card-metric:hover {
        transform: translateY(-5px);
    }
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1.5rem;
    }

    .bg-income { background-color: #d1fae5; color: #059669; }
    .bg-outcome { background-color: #fee2e2; color: #dc2626; }
    .bg-balance { background-color: #dbeafe; color: #2563eb; }
    .bg-pending { background-color: #fef3c7; color: #d97706; }
</style>
@endpush

@section('content')

<div class="container-fluid">

    {{-- TOP BAR --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Dashboard Overview</h2>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-warning position-relative text-white fw-bold">
                <i class="fa-solid fa-bell"></i> Pending
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user-circle me-1"></i> Admin User
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- METRICS --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-metric p-3">
                <p class="text-muted mb-1">Total Income</p>
                <h4 class="fw-bold text-success">$24,500.00</h4>
                <div class="icon-box bg-income ms-auto">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-metric p-3">
                <p class="text-muted mb-1">Total Outcome</p>
                <h4 class="fw-bold text-danger">$12,200.00</h4>
                <div class="icon-box bg-outcome ms-auto">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-metric p-3">
                <p class="text-muted mb-1">Net Balance</p>
                <h4 class="fw-bold text-primary">$12,300.00</h4>
                <div class="icon-box bg-balance ms-auto">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-metric p-3 border border-warning">
                <p class="text-muted mb-1">Pending Approval</p>
                <h4 class="fw-bold text-warning">3 Requests</h4>
                <div class="icon-box bg-pending ms-auto">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Recent Pending Requests</h5>
            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Request Date</th>
                        <th>Requested By</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4">Jan 25, 2026</td>
                        <td>Ahmed (Accountant)</td>
                        <td>Salary Payment</td>
                        <td><span class="badge bg-info">Salary</span></td>
                        <td class="fw-bold">$1,200.00</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-success"><i class="fa-solid fa-check"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></button>
                            <button class="btn btn-sm btn-secondary"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

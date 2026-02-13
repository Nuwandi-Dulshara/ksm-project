@extends('layouts.app')

@section('content')

<style>
body{
    background:#f8f9fa;
}

/* Card */
.card{
    border-radius:12px;
}

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

.form-control,
.form-select{
    border:1px solid #ced4da;
    box-shadow:none;
}

.form-control:focus,
.form-select:focus{
    border:1px solid #ced4da;
    box-shadow:none;
}

.hidden-section{
    display:none;
}
</style>


<div class="container-fluid px-4 py-4">

    <div class="d-flex align-items-center mb-4">

        <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary rounded-circle me-3">
            <i class="fa fa-arrow-left"></i>
        </a>

        <div>
            <h3 class="fw-bold mb-0">New Expense Registration</h3>
            <small class="text-muted">Record company expenses</small>
        </div>

    </div>


    <div class="row justify-content-center">
    <div class="col-lg-10">

    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm border-0">
        <div class="card-body p-4">

        <div class="form-section-title">New Expense Registration Form</div>

        <div class="row g-3">

        <!-- DATE -->
        <div class="col-md-6">
            <label class="form-label fw-bold">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <!-- TITLE -->
        <div class="col-md-6">
            <label class="form-label fw-bold">Expense Title</label>
            <input type="text" name="title" class="form-control" placeholder="Example: Office Lunch" required>
        </div>

        <!-- EXPENSE TYPE -->
        <div class="col-12">
        <label class="form-label text-muted small">Expense Type</label>

        <div class="row g-2">

        <div class="col-3">
            <input type="radio" class="btn-check" name="expense_type" id="general" value="general" checked>
            <label class="btn btn-outline-primary w-100" for="general">
            <i class="fa fa-mug-hot d-block"></i>General
            </label>
        </div>

        <div class="col-3">
            <input type="radio" class="btn-check" name="expense_type" id="salary" value="salary">
            <label class="btn btn-outline-primary w-100" for="salary">
            <i class="fa fa-user-tie d-block"></i>Salary
            </label>
        </div>

        <div class="col-3">
            <input type="radio" class="btn-check" name="expense_type" id="freelancer" value="freelancer">
            <label class="btn btn-outline-primary w-100" for="freelancer">
            <i class="fa fa-laptop-code d-block"></i>Freelancer
            </label>
        </div>

        <div class="col-3">
            <input type="radio" class="btn-check" name="expense_type" id="charity" value="charity">
            <label class="btn btn-outline-primary w-100" for="charity">
            <i class="fa fa-hand-holding-heart d-block"></i>Charity
            </label>
        </div>

        </div>
        </div>

        <!-- Paid To -->
        <div class="col-md-6">
            <label class="form-label text-muted small">Paid To</label>
            <input type="text" name="paid_to" class="form-control">
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label class="form-label text-muted small">Status</label>
            <select name="status" class="form-select">
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <!-- Amount -->
        <div class="col-md-6">
            <label class="form-label text-muted small">Amount</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="amount" class="form-control" required>
            </div>
        </div>

        <!-- Receipt -->
        <div class="col-12">
            <div class="form-section-title">Receipt</div>
            <label class="form-label text-muted small">Upload receipt (PDF/Image)</label>
            <input type="file" name="receipt" class="form-control">
        </div>

        </div>

        <!-- SUBMIT -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('expenses.index') }}" class="btn btn-light border">Cancel</a>
            <button type="submit" class="btn btn-primary fw-bold px-4">
                <i class="fa-solid fa-save me-2"></i> Save Expense Details
            </button>
        </div>

        </div>
        </div>

    </form>

    </div>
    </div>

</div>


<script>
const radios = document.querySelectorAll('input[name="expense_type"]');

radios.forEach(radio => {
    radio.addEventListener("change", toggleSections);
});

function toggleSections(){
    // You can extend this later if needed
}

</script>

@endsection

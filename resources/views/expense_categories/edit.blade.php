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

    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('expense-categories.index') }}"
           class="btn btn-outline-secondary me-3 rounded-circle"
           style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-dark mb-0">Edit Expense Category</h2>
            <p class="text-muted mb-0">Update category details.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <form action="{{ route('expense-categories.update', $expenseCategory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <div class="form-section-title">Expense Category</div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Expense Type</label>
                                <select name="expense_type" class="form-select" required>
                                    <option value="General" {{ $expenseCategory->expense_type == 'General' ? 'selected' : '' }}>General</option>
                                    <option value="Salary" {{ $expenseCategory->expense_type == 'Salary' ? 'selected' : '' }}>Salary</option>
                                    <option value="Freelancer" {{ $expenseCategory->expense_type == 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
                                    <option value="Help" {{ $expenseCategory->expense_type == 'Help' ? 'selected' : '' }}>Help</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Expense Category</label>
                                <input type="text"
                                       name="category_name"
                                       class="form-control"
                                       value="{{ $expenseCategory->category_name }}"
                                       required>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('expense-categories.index') }}"
                               class="btn btn-light border">Cancel</a>

                            <button type="submit" class="btn btn-primary fw-bold px-4">
                                <i class="fa-solid fa-save me-2"></i> Update Expense Category
                            </button>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection

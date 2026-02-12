<div class="sidebar d-flex flex-column p-3">
    <h3 class="mb-4 ps-2 fw-bold">
        <i class="fa-solid fa-wallet me-2"></i> AccoSys
    </h3>
    <nav class="nav flex-column">
        <a href="{{ route('dashboard') }}" class="nav-link text-white active">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <a href="{{ route('incomes.index') }}" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-trend-up me-2"></i> Incomes
        </a>
        <a href="add-outcome.html" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-transfer me-2"></i> NEW Outcomes
        </a>

        <a href="outcomes.html" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-transfer me-2"></i> Outcomes ++
        </a>

        <a href="outcome-report.html" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-transfer me-2"></i> Outcome Report
        </a>
        <a href="approval-history.html" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-transfer me-2"></i> Approval
            history
        </a>

        <a href="category-summary.html" class="nav-link text-white">
            <i class="fa-solid fa-money-bill-transfer me-2"></i> Summary of
            Ouctome
        </a>

        <hr class="text-white-50" />

        <a href="add-employee.html" class="nav-link text-white">
            <i class="fa-solid fa-users me-2"></i> Employees
        </a>

        <a href="monthly-salary-approval.html" class="nav-link text-white">
            <i class="fa-solid fa-users me-2"></i>Monthly Salary List
        </a>

        <a href="listofmonthsalary.html" class="nav-link text-white">
            <i class="fa-solid fa-users me-2"></i>APPROVE Salary List
        </a>

        <a href="{{ route('donators.index') }}" class="nav-link text-white">
            <i class="fa-solid fa-hand-holding-dollar me-2"></i> Donators
        </a>
        <a href="people-list.html" class="nav-link text-white">
            <i class="fa-solid fa-laptop-code me-2"></i> Freelancers
        </a>

        <a href="social-media.html" class="nav-link text-white">
            <i class="fa-solid fa-bullhorn me-2"></i> Social Media
        </a>
        <a href="add-beneficiary.html" class="nav-link text-white">
            <i class="fa-solid fa-hand-holding-heart me-2"></i> Help / Charity
        </a>
        <a href="{{ route('roles.index') }}" class="nav-link text-white">
            <i class="fa-solid fa-layer-group me-2"></i> Role
        </a>


        <a href="{{ route('users.index') }}" class="nav-link text-white">
            <i class="fa-solid fa-user me-2"></i> Users
        </a>

        <a href="settings.html"
            ><i class="fa-solid fa-gear me-2"></i> Settings</a
        >

        <a href="outcome-receipt.html" class="btn btn-sm btn-light">
            <i class="fa-solid fa-print"></i>
        </a>
    </nav>
</div>

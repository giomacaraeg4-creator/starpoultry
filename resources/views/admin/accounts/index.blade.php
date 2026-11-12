
@extends('layouts.admin')

@section('title', 'Account Management')

@section('page-heading', 'Account Management')

@section('content')

<div class="account-page">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1>Account Management</h1>
        <p>Manage registered users and approve Farm Supervisor accounts.</p>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="account-alert account-alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- ERROR MESSAGE -->
    @if ($errors->any())
        <div class="account-alert account-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>

            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- STATISTICS -->
    <div class="account-stats">

        <div class="account-stat-card">
            <div>
                <p>Total Accounts</p>
                <h2>{{ $stats['total'] }}</h2>
                <span>All registered accounts</span>
            </div>

            <div class="account-stat-icon icon-total">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="account-stat-card">
            <div>
                <p>Approved Accounts</p>
                <h2>{{ $stats['approved'] }}</h2>
                <span>Approved users</span>
            </div>

            <div class="account-stat-icon icon-approved">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>

        <div class="account-stat-card">
            <div>
                <p>Pending Registrations</p>
                <h2>{{ $stats['pending'] }}</h2>
                <span>Awaiting approval</span>
            </div>

            <div class="account-stat-icon icon-pending">
                <i class="fa-solid fa-user-clock"></i>
            </div>
        </div>

        <div class="account-stat-card">
            <div>
                <p>Rejected Accounts</p>
                <h2>{{ $stats['rejected'] }}</h2>
                <span>Rejected registrations</span>
            </div>

            <div class="account-stat-icon icon-rejected">
                <i class="fa-solid fa-user-xmark"></i>
            </div>
        </div>

    </div>

    <!-- ACCOUNT TABS -->
    <div class="account-tabs">

        <a href="{{ route('admin.accounts.index', ['tab' => 'all']) }}"
           class="account-tab {{ $activeTab === 'all' ? 'active' : '' }}">

            <i class="fa-solid fa-users"></i>
            <span>All Accounts</span>

            <span class="tab-count">
                {{ $stats['total'] }}
            </span>
        </a>

        <a href="{{ route('admin.accounts.index', ['tab' => 'pending']) }}"
           class="account-tab {{ $activeTab === 'pending' ? 'active' : '' }}">

            <i class="fa-solid fa-clock"></i>
            <span>Pending Approvals</span>

            <span class="tab-count pending-count">
                {{ $stats['pending'] }}
            </span>
        </a>

    </div>

    <!-- ACCOUNT TABLE SECTION -->
    <section class="account-table-section">

        <div class="account-table-heading">

            <div>
                @if ($activeTab === 'pending')
                    <h3>Pending Approvals</h3>
                    <p>Review and approve Farm Supervisor registrations.</p>
                @else
                    <h3>All Registered Accounts</h3>
                    <p>View and manage all registered system accounts.</p>
                @endif
            </div>

            <span class="account-total">
                {{ $accounts->total() }} records found
            </span>

        </div>

        <!-- SEARCH AND FILTERS -->
        <form method="GET"
              action="{{ route('admin.accounts.index') }}"
              class="account-filters">

            <input type="hidden" name="tab" value="{{ $activeTab }}">

            <div class="account-search">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search username..."
                >
            </div>

            <select name="role" class="account-filter-select">
                <option value="">All Roles</option>

                <option value="ADMIN"
                    {{ $role === 'ADMIN' ? 'selected' : '' }}>
                    Administrator
                </option>

                <option value="EMPLOYEE"
                    {{ $role === 'EMPLOYEE' ? 'selected' : '' }}>
                    Farm Supervisor
                </option>
            </select>

            @if ($activeTab === 'all')
                <select name="approval_status"
                        class="account-filter-select">

                    <option value="">All Approval Status</option>

                    <option value="PENDING"
                        {{ $approvalStatus === 'PENDING' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="APPROVED"
                        {{ $approvalStatus === 'APPROVED' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="REJECTED"
                        {{ $approvalStatus === 'REJECTED' ? 'selected' : '' }}>
                        Rejected
                    </option>

                </select>
            @endif

            <button type="submit" class="account-filter-button">
                <i class="fa-solid fa-filter"></i>
                Filter
            </button>

            <a href="{{ route('admin.accounts.index', ['tab' => $activeTab]) }}"
               class="account-reset-button">
                Reset
            </a>

        </form>

        <!-- ACCOUNTS TABLE -->
        <div class="table-wrapper">

            <table class="account-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Account Status</th>
                        <th>Approval Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($accounts as $account)

                        <tr>

                            <td>{{ $account->id }}</td>

                            <td class="account-username">
                                <div class="account-user-cell">

                                    <div class="account-user-avatar">
                                        {{ strtoupper(substr($account->user_name, 0, 1)) }}
                                    </div>

                                    <strong>
                                        {{ $account->user_name }}
                                    </strong>

                                </div>
                            </td>

                            <td>
                                @if ($account->role === 'ADMIN')
                                    <span class="account-role role-admin">
                                        <i class="fa-solid fa-shield-halved"></i>
                                        Administrator
                                    </span>
                                @else
                                    <span class="account-role role-employee">
                                        <i class="fa-solid fa-user"></i>
                                        Farm Supervisor
                                    </span>
                                @endif
                            </td>

                            <!-- ACCOUNT STATUS -->
                            <td>
                                @if ($account->status === 'ACTIVE')
                                    <span class="account-status status-active">
                                        <span></span>
                                        ACTIVE
                                    </span>
                                @else
                                    <span class="account-status status-inactive">
                                        <span></span>
                                        INACTIVE
                                    </span>
                                @endif
                            </td>

                            <!-- APPROVAL STATUS -->
                            <td>
                                @if ($account->approval_status === 'APPROVED')
                                    <span class="account-status status-approved">
                                        APPROVED
                                    </span>
                                @elseif ($account->approval_status === 'PENDING')
                                    <span class="account-status status-pending">
                                        PENDING
                                    </span>
                                @else
                                    <span class="account-status status-rejected">
                                        REJECTED
                                    </span>
                                @endif
                            </td>

                            <!-- ACTIONS -->
                            <td>

                                @if (
                                    $account->role === 'EMPLOYEE' &&
                                    $account->approval_status === 'PENDING'
                                )

                                    <div class="account-actions">

                                        <!-- APPROVE -->
                                        <form
                                            action="{{ route('admin.accounts.approve', $account->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Approve this Farm Supervisor account?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="account-action-btn approve-btn">
                                                <i class="fa-solid fa-check"></i>
                                                Approve
                                            </button>
                                        </form>

                                        <!-- REJECT -->
                                        <form
                                            action="{{ route('admin.accounts.reject', $account->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Reject this registration?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="account-action-btn reject-btn">
                                                <i class="fa-solid fa-xmark"></i>
                                                Reject
                                            </button>
                                        </form>

                                    </div>

                                @else

                                    <span class="no-account-action">
                                        No actions available
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="account-empty">

                                <i class="fa-solid fa-users"></i>

                                @if ($activeTab === 'pending')
                                    <strong>No pending registrations</strong>
                                    <span>There are currently no accounts waiting for approval.</span>
                                @else
                                    <strong>No accounts found</strong>
                                    <span>Try changing your search or filter.</span>
                                @endif

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        @if ($accounts->hasPages())
            <div class="account-pagination">

                <div class="pagination-info">
                    Showing
                    {{ $accounts->firstItem() ?? 0 }}
                    to
                    {{ $accounts->lastItem() ?? 0 }}
                    of
                    {{ $accounts->total() }} accounts
                </div>

                <div class="pagination-links">
                    {{ $accounts->links() }}
                </div>

            </div>
        @endif

    </section>

</div>

@endsection

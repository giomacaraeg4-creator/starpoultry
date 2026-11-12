<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountManagementController extends Controller
{
    public function index(Request $request): View
    {
        // Determine active tab
        $activeTab = $request->query('tab', 'all');

        if (!in_array($activeTab, ['all', 'pending'], true)) {
            $activeTab = 'all';
        }

        // Search and filter values
        $search = trim($request->query('search', ''));

        $role = $request->query('role', '');

        $approvalStatus = $request->query('approval_status', '');

        // Account statistics
        $stats = [
            'total' => Account::count(),

            'approved' => Account::where(
                'approval_status',
                'APPROVED'
            )->count(),

            'pending' => Account::where(
                'approval_status',
                'PENDING'
            )->count(),

            'rejected' => Account::where(
                'approval_status',
                'REJECTED'
            )->count(),
        ];

        // Base account query
        $query = Account::query();

        // Pending tab only displays pending registrations
        if ($activeTab === 'pending') {
            $query->where('approval_status', 'PENDING');
        } else {
            // Apply approval filter on All Accounts tab
            if (in_array($approvalStatus, [
                'PENDING',
                'APPROVED',
                'REJECTED'
            ], true)) {
                $query->where(
                    'approval_status',
                    $approvalStatus
                );
            }
        }

        // Filter by role
        if (in_array($role, ['ADMIN', 'EMPLOYEE'], true)) {
            $query->where('role', $role);
        }

        // Search by username
        if ($search !== '') {
            $query->where(
                'user_name',
                'ILIKE',
                '%' . $search . '%'
            );
        }

        // Retrieve accounts with pagination
        $accounts = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.accounts.index', compact(
            'accounts',
            'stats',
            'activeTab',
            'search',
            'role',
            'approvalStatus'
        ));
    }

    public function approve(int $id): RedirectResponse
    {
        $account = Account::findOrFail($id);

        if (
            $account->role !== 'EMPLOYEE' ||
            $account->approval_status !== 'PENDING'
        ) {
            return back()->withErrors([
                'account' => 'This account cannot be approved.'
            ]);
        }

        $account->update([
            'approval_status' => 'APPROVED',
            'status' => 'ACTIVE',
        ]);

        return back()->with(
            'success',
            'Farm Supervisor account successfully approved.'
        );
    }

    public function reject(int $id): RedirectResponse
    {
        $account = Account::findOrFail($id);

        if (
            $account->role !== 'EMPLOYEE' ||
            $account->approval_status !== 'PENDING'
        ) {
            return back()->withErrors([
                'account' => 'This account cannot be rejected.'
            ]);
        }

        $account->update([
            'approval_status' => 'REJECTED',
        ]);

        return back()->with(
            'success',
            'Farm Supervisor registration rejected.'
        );
    }
}

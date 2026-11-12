<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Account;

class CheckRole
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        // Check if user is logged in
        $accountId = $request->session()->get('account_id');

        if (!$accountId) {
            return redirect()->route('login');
        }

        // Verify account from database
        $account = Account::find($accountId);

        if (!$account) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        // Check account status
        if (
            $account->status !== 'ACTIVE' ||
            $account->approval_status !== 'APPROVED'
        ) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        // Check role
        if (!in_array($account->role, $roles, true)) {
            abort(403, 'Unauthorized access.');
        }

        // Refresh session account information
        $request->session()->put([
            'user_name' => $account->user_name,
            'role' => $account->role,
        ]);

        $response = $next($request);

        // Prevent browser caching
        $response->headers->set(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, max-age=0'
        );

        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}

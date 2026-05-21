<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Get user's roles
        $userRoles = DB::table('set_roles')
            ->join('roles', 'set_roles.role_id', '=', 'roles.id')
            ->where('set_roles.user_id', $user->id)
            ->pluck('roles.role_name')
            ->toArray();

        if (!in_array($role, $userRoles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}

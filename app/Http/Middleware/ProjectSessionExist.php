<?php

namespace App\Http\Middleware;

use Auth;
use Flash;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectSessionExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->session_project == null) {
            Flash::error('Choise a Project to Manage');
            return redirect(route('projects.index'));
        }
        return $next($request);
    }
}

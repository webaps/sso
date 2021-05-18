<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    private function checkIfUserIsAdmin($user)
    {
        // return ($user->is_admin == 1);
        return true;
    }

    private function respondToUnauthorizedRequest(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            return redirect()->guest(backpack_url('login'));
        }
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if (!$this->checkIfUserIsAdmin(Auth::user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\Request;

class SessionIsOpen
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        //dd($request->query);
        try {

            $session = Session::where('slug', $request->route('slug'))
                ->orWhere('id', $request->query('session_id'))
                ->first();

            //@todo make a custom exception in order to redirect to a custom view (this session no longer exists...)
            if ($session == null)
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Model with slug '.$request->route('slug').' not found');
            if (!$session->open)
                return \abort(403, 'unauthorized');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return \abort(404, 'Not found');
            //\dd($e->getMessage());

        }

        return $next($request);
    }
}

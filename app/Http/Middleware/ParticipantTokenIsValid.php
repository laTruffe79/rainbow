<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParticipantTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {

        try {

            $session = Session::where('slug', $request->route('slug'))
                ->orWhere('id', $request->query('session_id'))
                ->first();
            $sessionParticipantToken = \Illuminate\Support\Facades\Session::get('token');
            //\dd($sessionParticipantToken);
            if($sessionParticipantToken !== null){

                $participant = \App\Models\Participant::where('token',$sessionParticipantToken)->first();

                if($participant !== null){

                    if(!\boolval($participant->token_is_valid)){

                        return \abort(403, 'unauthorized');

                    }

                }

            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return \abort(404, 'Not found');
            //\dd($e->getMessage());

        }

        return $next($request);
    }
}

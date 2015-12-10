<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

class RoleMiddleware
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $use;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->user = \Auth::user();
        if($this->user != null){
            if($this->user->role == 99){
                $this->user->role = "admin";
            }else if($this->user->role== 1){
                $this->user->role = 'new' ;
            }else if($this->user->role == 2){
                $this->user->role = 'old' ;
            }
        }
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($this->user->role != $role) {
            // Redirect...
            //var_dump('role>>'.$role);
            //var_dump('user role>>'.$this->user->role);
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
               return redirect()->intended('/?role');
            }
        }

        return $next($request);
    }
}

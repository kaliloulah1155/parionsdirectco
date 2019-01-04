<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class SessionTimeout
{
    protected $session;
    protected $timeout = 1200;

    public function __construct(Store $session){
        $this->session = $session;
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        $isLoggedIn = $request->path() != '/admin/logout';
        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : '/admin/dashboard');
           // $email = $request->user()->email;
            auth()->logout();
            return redirect(route('index'));
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }

}

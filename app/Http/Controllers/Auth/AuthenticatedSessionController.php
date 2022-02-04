<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Admin\LoginResource;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if ($request->expectsJson()) {
            return $this->loginApi($request);
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function loginApi(Request $request)
    {
        $passport = Client::where('personal_access_client', false)
                        ->first();
        try {
            $response = Http::asForm()->post(route('passport.token'), [
                    'grant_type'    => 'password',
                    'client_id'     => $passport->id,
                    'client_secret' => $passport->secret,
                    'username'      => $request->username,
                    'password'      => $request->password,
                    'scope'         => '*',
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

        return new LoginResource($response->json());
    }
}

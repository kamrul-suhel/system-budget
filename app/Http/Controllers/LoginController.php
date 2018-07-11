<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponser;
    //

    public function login(Request $request)
    {
        $email_login = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $username_login = [
            'username' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if ((!Auth::attempt($email_login)) && (!Auth::attempt($username_login))) {
            $redirect = ($request->input('redirect')) ? '?redirect=' . $request->input('redirect') : '';

            $error = [
                'note' => 'Invalid login, please try again.',
                'note_type' => 'error'
            ];

            if ($request->ajax() || $request->isJson()) {
                return $this->errorResponse('Invalid login, please try again.');
            }

            return Redirect::to('login' . $redirect)->with($error);
        }

        $redirect_route = '';
        $client = '';
        $user = '';
        $offers = '';

//        if (key_exists(Auth::user()->role, config('roles.admins'))) {
//            $redirect_route = '/admin';
//        } elseif (key_exists(Auth::user()->role, config('roles.clients'))) {
//
//            $user = Auth::user();
//            $client = Auth::user()->client();
//            $offers = $user->userOffers();
//        }

        $redirect = ($request->input('redirect')) ?: $redirect_route;

        if ($request->ajax() || $request->isJson()) {
            $response_data['redirect_url'] = $redirect;
            $response_data['error'] = false;
            $response_data['client'] = $client;
            $response_data['user'] = $user;
            $response_data['user_offers'] = $offers;
            return $this->successResponse($response_data, 200);
        }

        return Redirect::to($redirect);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function view()
    {
        return view('login');
    }

    public function LoginProcess(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username Wajib di Isi',
                'password.required' => 'Password Wajib di Isi',
            ]
        );

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return response()->json(['Profil diri berhasil diperbarui']);
        } else {
            return back();
        }
    }
}
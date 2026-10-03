<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLogged') === true) {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() !== 'POST') {
            return view('auth/login');
        }

        $rules = [
            'username' => 'required|max_length[100]',
            'password' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Enter your username and password.');
        }

        $credentials = $this->request->getPost(['username', 'password']);
        $user = (new UserModel())->where('username', $credentials['username'])->first();

        $validPassword = $user !== null
            && (password_verify($credentials['password'], $user['password'])
                || hash_equals((string) $user['password'], (string) $credentials['password']));

        if (! $validPassword) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'isLogged' => true,
            'user_id'  => $user['id'],
            'username' => $user['username'],
        ]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->remove(['isLogged', 'user_id', 'username']);
        session()->regenerate(true);
        session()->setFlashdata('success', 'You have been logged out.');

        return redirect()->to('http://localhost/ci4_loginsession/login');
    }
}
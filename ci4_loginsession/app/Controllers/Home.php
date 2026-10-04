<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    
  
    public function login()
    {
        if (session()->get('isLogged') === true) {
            return redirect()->to('http://localhost/ci4_pagination/index.php');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|max_length[255]',
                'password' => 'required',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Enter both your username and password.');
            }

            $credentials = $this->request->getPost(['username', 'password']);
            $user = (new UserModel())->where('username', $credentials['username'])->first();

            $validPassword = false;
            if ($user !== null) {
                $storedPassword = (string) ($user['password'] ?? '');

                if (password_verify($credentials['password'], $storedPassword)) {
                    $validPassword = true;
                } elseif (hash_equals($storedPassword, $credentials['password'])) {
                    $validPassword = true;
                    $hashedPassword = password_hash($credentials['password'], PASSWORD_DEFAULT);
                    (new UserModel())->update($user['id'], ['password' => $hashedPassword]);
                }
            }

            if (! $validPassword) {
                return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
            }

            session()->regenerate();
            session()->set([
                'isLogged' => true,
                'user_id'  => $user['id'],
                'username' => $user['username'],
            ]);

            return redirect()->to('http://localhost/ci4_pagination/index.php');
        }

        return view('login');
    }

    public function dashboard()
    {
        if (session()->get('isLogged') !== true) {
            return redirect()->to('/login');
        }

        return view('dashboard', [
            'username' => session()->get('username'),
        ]);
    }

    public function logout()
    {
        if (session()->get('isLogged') !== true) {
            return redirect()->to('/login');
        }

        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }


    
}

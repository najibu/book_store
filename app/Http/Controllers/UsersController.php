<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\BaseController;

class UsersController extends BaseController
{
    /**
     * [postLogin description]
     * @return [type] [description]
     */
    public function postLogin()
    {
      $email = Input::get('email');
      $password = Input::get('password');

      if (Auth::attempt(array(
        'email' => $email, 
        'password' => $password
        ))) {
        return redirect('index');
      } else {
        return redirect('index')->with('error', 'Please check your password & email');
      }
    }

    public function getLogout()
    {
      Auth::logout();
      return redirect('index');
    }
}

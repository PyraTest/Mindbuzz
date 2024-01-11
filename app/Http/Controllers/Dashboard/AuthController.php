<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
  /**
   * Return to login blade
   */
  public function login()
  {
    return view('dashboard.auth.login');
  }


  /**
   * Login Function
   */
  public function doLogin(Request $request)
  {
    $data = $request->validate([
      'username' => 'required|string|max:191',
      'password' => 'required|string'
    ]);
    // $new_pass = bcrypt($data['password']);

    if (!auth()->guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password']])) {

    //   return Redirect::back()->withErrors(['Try With Correct Email and Password!!']);
      session()->flash('error', __("user.error_credentials"));
      return redirect()->back();
    }
    session()->flash('success', __('user.succes_login'));
    return redirect(route('admin.dashboard'));
  }

  /**
   * Logout Function
   */

  public function logout()
  {
    auth()->guard('admin')->logout();
    return redirect(route('admin.login'));
  }
}

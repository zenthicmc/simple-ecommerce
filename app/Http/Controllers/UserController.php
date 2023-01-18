<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
   {
      $data = [
         'title' => 'Admin | Users',
         'users' => User::all(),
      ];
      return view('dashboard.users', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Admin | Users',
      ];
      return view('dashboard.users_new', $data);
   }

   public function create_store(Request $request)
   {
      $request->validate([
         'name' => ['required', 'string', 'max:255', 'unique:users'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'pwd' => ['required', Rules\Password::defaults()],
         'pwd_cnfrm' => ['required', 'same:pwd'],
         'role' => ['required', 'string', 'max:255'],
      ]);

      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->pwd),
         'role' => $request->role,
      ]);

      return redirect()->route('users')->with('success', 'User created successfully');
   }

   public function edit($id)
   {
      $data = [
         'title' => 'Admin | Users',
         'user' => User::find($id),
      ];
      return view('dashboard.users_edit', $data);
   }

   public function edit_store($id, Request $request)
   {
      $user = User::find($id);
      $request->name != $user->name ? $rules_name = $rules_name = ['required', 'string', 'max:255', 'unique:users'] : $rules_name = ['required', 'string', 'max:255'];
      $request->email != $user->email ? $rules_email = ['required', 'string', 'email', 'max:255', 'unique:users'] : $rules_email = ['required', 'string', 'email', 'max:255'];
      $request->pwd ? $rules_pwd = ['required', Rules\Password::defaults()] : $rules_pwd = [];
      $request->pwd_cnfrm ? $rules_pwd_cnfrm = ['required', 'same:pwd'] : $rules_pwd_cnfrm = [];

      $request->validate([
         'name' => $rules_name,
         'email' => $rules_email,
         'pwd' => $rules_pwd,
         'pwd_cnfrm' => $rules_pwd_cnfrm,
         'role' => ['required', 'string', 'max:255'],
      ]);

      $request->pwd ? $value_pwd = Hash::make($request->pwd) : $value_pwd = $user->password;

      $user->update([
         'name' => $request->name,
         'email' => $request->email,
         'password' => $value_pwd,
         'role' => $request->role,
      ]);
      return redirect()->route('users')->with('success', 'User updated successfully');
   }

   public function delete($id)
   {
      $user = User::find($id);
      $user->delete();
      return redirect()->route('users')->with('success', 'User deleted successfully');
   }
}

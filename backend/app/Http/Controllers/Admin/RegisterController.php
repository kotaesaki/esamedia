<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_status' => ['required', 'string', 'max:20'],
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'login_id' => $request->login_id,
                'user_status' => $request->user_status,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect('admin/home/users');
    }
}

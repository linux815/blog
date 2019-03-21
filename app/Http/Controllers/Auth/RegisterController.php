<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\UserController;
use App\Http\Requests\RegisterRequest;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth()->check()) {
            $this->middleware('auth');
        } else {
            $this->middleware('guest');
        }
    }

    /**
     * @param RegisterRequest $request
     *
     * @return array
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request)));

        if (!auth()->check()) {
            $this->guard()->login($user);
        }

        return $this->registered($request, $user)
            ?: (new UserController())->me();
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return \App\User
     */
    protected function create(RegisterRequest $request): User
    {
        $createdUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('name', Role::ROLE_EDITOR)->first();
        $createdUser->attachRole($role);

        return $createdUser;
    }
}

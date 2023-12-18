<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Core\Blood;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        $bloodTypes = BloodType::pluck('code', 'id');


        return view('auth.register', ['blood_types' => $bloodTypes]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'blood_type' => ['required', 'exists:blood_types,code'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],

            'pincode' => ['required', 'integer'],
            'pincode_name' => ['required', 'string'],
            'mobile' => Rule::unique('users')->where(function ($query) use ($request) {
                return $query->where('dial_code', $request->input('dial_code'))
                    ->where('mobile', $request->input('mobile'));
            }),


            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);





        list($city, $district, $state) = explode('/', $request->input('pincode_name'));



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'blood_type_id' => BloodType::whereCode($request->blood_type)->pluck('id')->first(),
            'zip_code' => $request->pincode,
            'city' => $city,
            'district' => $district,
            'state' => $state,
            'country' => 'India',
            'dial_code' => $request->input('dial_code'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->password),
            'last_donated_at' => $request->last_donated_at ?? null
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

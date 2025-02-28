<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $requestData = $request->all();
        if (isset($requestData['doctor'])) {
            $validationRules = array_merge($validationRules, [
                'doctor.organization' => ['required', 'string', 'max:255'],
                'doctor.radiology' => ['required', 'integer'],
                'doctor.radiography' => ['required', 'integer'],
            ]);
        }

        $request->validate($validationRules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($requestData['doctor'])) {
            $UserResource = new UserResource($user);
            $doctor = $user->doctor()->create($request->doctor);
            $UserResource->additional(['doctor' => $doctor]);
        }

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}

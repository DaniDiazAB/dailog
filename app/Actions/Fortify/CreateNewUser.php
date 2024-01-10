<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Rules\EdadMinima;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {


        Validator::make($input, [
            'nickname' => ['required', 'string', 'max:255', 'min:5'],
            'name' => ['required', 'string', 'max:255'],
            'biografia' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'fecha' => ['required', 'date', new EdadMinima],


            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $isPublic = 0;


        if (isset($input['publico'])) {
            $isPublic = 1;
        } 

        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nickname' => $input['nickname'],
            'biografia' => $input['biografia'],
            'fecha_nacimiento' => $input['fecha'],
            'is_perfil_publico' => $isPublic,
            'rol' => 'normal',
        ]);
        
        
    }
}

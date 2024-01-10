<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EdadMinima implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }
    public function passes($attribute, $value){
        $fechaNacimiento = new \DateTime($value);
        $hoy = new \DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;

        return $edad >= 18;
    }
    public function message(){
        return 'Debes ser mayor de 13 años para registrarte.';
    }
}

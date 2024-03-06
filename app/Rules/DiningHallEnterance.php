<?php

namespace App\Rules;

use App\Models\Transitions;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DiningHallEnterance implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $enteranceCount = Transitions::where('dining_hall_id', $value)->whereDate('created_at', now())->count();
        if ($enteranceCount >= 50) {
            $fail('Dining Hall Enterance is closed');
        }
    }
}

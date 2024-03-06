<?php

namespace App\Rules;

use App\Models\Transitions;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class TransitionsCount implements ValidationRule, DataAwareRule
{

    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    // ...

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $transitionCount = Transitions::where('dining_hall_id', $this->data["dining_hall_id"])
            ->where('user_id', $value)
            ->WhereDate('created_at', now())
            ->count();
        if ($transitionCount >= 2) {
            $fail("Transition denied");
        }
    }
}

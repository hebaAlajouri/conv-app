<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', $this->route('expense')); // Implement ExpensePolicy
    }

    public function rules(): array
    {
        return [
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'expense_date' => 'required|date',
        ];
    }
}
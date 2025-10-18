<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'expense_date' => 'required|date',
        ], [
            'category.required' => 'Category is required.',
            'category.string' => 'Category must be a string.',
            'category.max' => 'Category may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a number.',
            'amount.min' => 'Amount must be at least 0.',
            'currency.required' => 'Currency is required.',
            'currency.string' => 'Currency must be a string.',
            'currency.size' => 'Currency must be exactly 3 characters.',
            'expense_date.required' => 'Expense date is required.',
            'expense_date.date' => 'Expense date must be a valid date.',
        ]);

        $expense = $request->user()->expenses()->create($validated);

        return redirect('/expenses')->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'expense_date' => 'required|date',
        ], [
            'category.required' => 'Category is required.',
            'category.string' => 'Category must be a string.',
            'category.max' => 'Category may not be greater than 255 characters.',
            'description.string' => 'Description must be a string.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a number.',
            'amount.min' => 'Amount must be at least 0.',
            'currency.required' => 'Currency is required.',
            'currency.string' => 'Currency must be a string.',
            'currency.size' => 'Currency must be exactly 3 characters.',
            'expense_date.required' => 'Expense date is required.',
            'expense_date.date' => 'Expense date must be a valid date.',
        ]);

        $expense->update($validated);

        return redirect('/expenses')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $expense->delete();

        return redirect('/expenses')->with('success', 'Expense deleted successfully!');
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense; // Assuming you need to pass data for edit view

class WebController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function expensesIndex()
    {
        return view('expenses.index');
    }

    public function expensesCreate()
    {
        return view('expenses.create');
    }

    public function expensesEdit(Expense $expense)
    {
        // Add authorization check if needed
        return view('expenses.edit', compact('expense'));
    }

    public function summary()
    {
        return view('expenses.summary');
    }
}
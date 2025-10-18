@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen-minus-nav py-8">
    <!-- Add Expense Card -->
    <div class="w-full max-w-lg mx-4">
        <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Add New Expense</h2>
            </div>
            
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description (Optional):</label>
                    <textarea id="description" name="description" rows="3"
                              class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">{{ old('description') }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                    <input type="number" id="amount" name="amount" step="0.01" value="{{ old('amount') }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                </div>
                
                <div class="mb-4">
                    <label for="currency" class="block text-gray-700 text-sm font-bold mb-2">Currency:</label>
                    <select id="currency" name="currency" required
                            class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 bg-white">
                        @php
                            $defaultCurrency = old('currency', auth()->user()->preferred_currency ?? 'USD');
                        @endphp
                        <option value="USD" {{ $defaultCurrency == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                        <option value="EUR" {{ $defaultCurrency == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="GBP" {{ $defaultCurrency == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                        <option value="JPY" {{ $defaultCurrency == 'JPY' ? 'selected' : '' }}>JPY - Japanese Yen</option>
                        <option value="AUD" {{ $defaultCurrency == 'AUD' ? 'selected' : '' }}>AUD - Australian Dollar</option>
                        <option value="CAD" {{ $defaultCurrency == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                        <option value="CHF" {{ $defaultCurrency == 'CHF' ? 'selected' : '' }}>CHF - Swiss Franc</option>
                        <option value="CNY" {{ $defaultCurrency == 'CNY' ? 'selected' : '' }}>CNY - Chinese Yuan</option>
                        <option value="INR" {{ $defaultCurrency == 'INR' ? 'selected' : '' }}>INR - Indian Rupee</option>
                        <option value="AED" {{ $defaultCurrency == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                        <option value="SAR" {{ $defaultCurrency == 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                        <option value="JOD" {{ $defaultCurrency == 'JOD' ? 'selected' : '' }}>JOD - Jordanian Dinar</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="expense_date" class="block text-gray-700 text-sm font-bold mb-2">Expense Date:</label>
                    <input type="date" id="expense_date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200">
                </div>
                
                <div class="flex items-center justify-between gap-4">
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-bold py-3 px-6 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        Add Expense
                    </button>
                    <a href="/expenses" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl transition duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
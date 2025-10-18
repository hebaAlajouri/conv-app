@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen-minus-nav py-8">
    <!-- Register Card -->
    <div class="w-full max-w-md mx-4">
        <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Create New Account</h2>
            </div>

            <form action="{{ url('/register') }}" method="POST">
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
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                </div>

                <div class="mb-6">
                    <label for="preferred_currency" class="block text-gray-700 text-sm font-bold mb-2">Preferred Currency:</label>
                    <select id="preferred_currency" name="preferred_currency" required
                            class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 bg-white">
                        <option value="USD" {{ old('preferred_currency', 'USD') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                        <option value="EUR" {{ old('preferred_currency') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="GBP" {{ old('preferred_currency') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                        <option value="JPY" {{ old('preferred_currency') == 'JPY' ? 'selected' : '' }}>JPY - Japanese Yen</option>
                        <option value="AUD" {{ old('preferred_currency') == 'AUD' ? 'selected' : '' }}>AUD - Australian Dollar</option>
                        <option value="CAD" {{ old('preferred_currency') == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                        <option value="CHF" {{ old('preferred_currency') == 'CHF' ? 'selected' : '' }}>CHF - Swiss Franc</option>
                        <option value="CNY" {{ old('preferred_currency') == 'CNY' ? 'selected' : '' }}>CNY - Chinese Yuan</option>
                        <option value="INR" {{ old('preferred_currency') == 'INR' ? 'selected' : '' }}>INR - Indian Rupee</option>
                        <option value="AED" {{ old('preferred_currency') == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                        <option value="SAR" {{ old('preferred_currency') == 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                        <option value="JOD" {{ old('preferred_currency') == 'JOD' ? 'selected' : '' }}>JOD - Jordanian Dinar</option>
                    </select>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        Register
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <a href="/login" class="text-purple-600 hover:text-blue-600 font-semibold transition duration-200">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen-minus-nav">
    <!-- Login Card -->
    <div class="w-full max-w-md mx-4">
        <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Login</h2>
            </div>

            <form action="{{ url('/login') }}" method="POST">
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

                <div class="mb-5">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" required
                           class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        Login
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <a href="/register" class="text-blue-600 hover:text-purple-600 font-semibold transition duration-200">Don't have an account? Register now</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
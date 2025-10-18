@extends('layouts.app')

@section('content')
<div class="p-8 bg-white rounded-3xl shadow-xl border border-gray-100">
    <!-- Header Section -->
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-3 rounded-2xl shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Welcome to your Dashboard!
                </h1>
                <p class="text-gray-500 mt-1">Manage your expenses, view summaries, and track your spending efficiently.</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- View Expenses Card -->
        <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-200">
            <div class="absolute top-4 right-4 bg-blue-500 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3 mt-2">View Expenses</h3>
            <p class="text-blue-700 mb-6 leading-relaxed">See all your recorded expenses, filter, and sort them easily.</p>
            <a href="/expenses" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <span>Go to Expenses</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <!-- Add New Expense Card -->
        <div class="group relative bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-green-200">
            <div class="absolute top-4 right-4 bg-green-500 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-green-900 mb-3 mt-2">Add New Expense</h3>
            <p class="text-green-700 mb-6 leading-relaxed">Quickly log a new expense to keep track of your spending.</p>
            <a href="/expenses/create" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <span>Add Expense</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <!-- View Summary Card -->
        <div class="group relative bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-purple-200">
            <div class="absolute top-4 right-4 bg-purple-500 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-purple-900 mb-3 mt-2">View Summary</h3>
            <p class="text-purple-700 mb-6 leading-relaxed">Get a categorized breakdown of your spending over time.</p>
            <a href="/summary" class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                <span>View Summary</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoutButton').addEventListener('click', async function() {
        const token = localStorage.getItem('access_token');
        if (!token) {
            window.location.href = '/login';
            return;
        }

        try {
            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (response.ok) {
                localStorage.removeItem('access_token');
                window.location.href = '/login';
            } else {
                console.error('Logout failed:', await response.json());
                alert('Logout failed. Please try again.');
            }
        } catch (error) {
            console.error('Network error during logout:', error);
            alert('Network error during logout. Please check your connection.');
        }
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="p-8 bg-white rounded-3xl shadow-xl border border-gray-100">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent mb-2">Expense Summary</h1>
        <p class="text-gray-500">View your spending patterns and totals by category</p>
    </div>

    <!-- Filter Form -->
    <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-2xl border border-gray-200 mb-8">
        <form method="GET" action="{{ route('summary') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:flex-1">
                <label for="from" class="block text-gray-700 text-sm font-bold mb-2">From Date:</label>
                <input type="date" id="from" name="from" value="{{ request('from', now()->startOfMonth()->format('Y-m-d')) }}"
                       class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
            </div>
            <div class="w-full md:flex-1">
                <label for="to" class="block text-gray-700 text-sm font-bold mb-2">To Date:</label>
                <input type="date" id="to" name="to" value="{{ request('to', now()->format('Y-m-d')) }}"
                       class="shadow-sm appearance-none border border-gray-300 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
            </div>
            <div class="w-full md:w-auto">
                <button type="submit" class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold py-3 px-8 rounded-xl w-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Generate Report
                </button>
            </div>
        </form>
    </div>

    @php
        use App\Services\CurrencyConverterService;

        $from = request('from', now()->startOfMonth()->format('Y-m-d'));
        $to = request('to', now()->format('Y-m-d'));

        $expenses = auth()->user()->expenses()
            ->whereBetween('expense_date', [$from, $to])
            ->get();

        $converter = app(CurrencyConverterService::class);
        $preferredCurrency = auth()->user()->preferred_currency;

        $summary = $expenses->groupBy('category')->map(function($items) use ($converter, $preferredCurrency) {
            $totalConverted = 0;
            foreach ($items as $expense) {
                $totalConverted += $converter->convert($expense->amount, $expense->currency, $preferredCurrency);
            }
            return [
                'category' => $items->first()->category,
                'total' => round($totalConverted, 2),
                'currency' => $preferredCurrency,
                'count' => $items->count()
            ];
        });

        $totalOverall = $summary->sum('total');
    @endphp

    <div class="mt-8">
        @if($summary->count() > 0)
            <!-- Summary Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Summary from {{ $from }} to {{ $to }}</h2>
                    <p class="text-gray-500 mt-1">Total spending across {{ $summary->count() }} categories</p>
                </div>
                <div class="bg-gradient-to-br from-indigo-500 to-blue-600 text-white px-6 py-4 rounded-2xl shadow-lg">
                    <div class="text-sm font-semibold opacity-90">Grand Total</div>
                    <div class="text-3xl font-bold">{{ number_format($totalOverall, 2) }}</div>
                    <div class="text-sm opacity-90">{{ $preferredCurrency }}</div>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Number of Expenses</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total ({{ $preferredCurrency }})</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($summary as $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $item['category'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                        {{ $item['count'] }} expenses
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-gray-900">{{ number_format($item['total'], 2) }}</span>
                                    <span class="text-sm text-gray-500 ml-1">{{ $preferredCurrency }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gradient-to-r from-indigo-50 to-blue-50">
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900" colspan="2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Grand Total
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xl font-bold text-indigo-600">{{ number_format($totalOverall, 2) }}</span>
                                <span class="text-sm text-gray-600 ml-1">{{ $preferredCurrency }}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-600 text-lg font-medium mb-2">No expenses in the selected period</p>
                <p class="text-gray-400 mb-4">Try adjusting your date range or add some expenses</p>
                <a href="/expenses/create" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold py-2 px-6 rounded-xl transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Expense
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CurrencyConverterService;
use Carbon\Carbon;

class SummaryController extends Controller
{
    protected $currencyConverterService;

    public function __construct(CurrencyConverterService $currencyConverterService)
    {
        $this->currencyConverterService = $currencyConverterService;
    }

    public function summary(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ], [
            'from.required' => 'The from date is required.',
            'from.date' => 'The from date must be a valid date.',
            'to.required' => 'The to date is required.',
            'to.date' => 'The to date must be a valid date.',
            'to.after_or_equal' => 'The to date must be after or equal to the from date.',
        ]);

        $user = $request->user();
        $preferredCurrency = $user->preferred_currency;

        $from = Carbon::parse($request->from)->startOfDay();
        $to = Carbon::parse($request->to)->endOfDay();

        $expenses = $user->expenses()
            ->whereBetween('expense_date', [$from, $to])
            ->get();

        $summary = [];

        foreach ($expenses as $expense) {
            $convertedAmount = $this->currencyConverterService->convert(
                $expense->amount,
                $expense->currency,
                $preferredCurrency
            );

            if (!isset($summary[$expense->category])) {
                $summary[$expense->category] = 0;
            }
            $summary[$expense->category] += $convertedAmount;
        }

        $formattedSummary = [];
        foreach ($summary as $category => $total) {
            $formattedSummary[] = [
                'category' => $category,
                'total_spend' => round($total, 2),
                'currency' => $preferredCurrency,
            ];
        }

        return response()->json([
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'currency' => $preferredCurrency,
            'summary' => $formattedSummary,
        ]);
    }
}

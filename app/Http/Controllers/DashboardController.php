<?php

namespace App\Http\Controllers;

use App\Charts\TransactionsDeliveryChart;
use App\Models\Delivery;
use App\Models\Products;
use App\Models\StokistReport;
use App\Models\TransactionsProducts;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(TransactionsDeliveryChart $chart, Request $request)
    {
        $user = Auth::user();
        $role = $user->role->role_name ?? 'Tidak ada role';

        $chartInstance = $chart->build();

        $countProducts = Products::where('outlet_id', $user->outlet_id)->count();
        $countDeliveries = Delivery::where('from_outlet_id', $user->outlet_id)->count();
        $countTransactions = TransactionsProducts::where('outlet_id', $user->outlet_id)->count();
        $countStokist = StokistReport::where('outlet_id', $user->outlet_id)->count();

        $name = $user->name ?? 'Tidak ada nama';
        $outlet = $user->outlet->outlet_name ?? 'Tidak ada outlet';

        $transactions = TransactionsProducts::where('outlet_id', $user->outlet_id)->get();
        $deliveries = Delivery::where('from_outlet_id', $user->outlet_id)->get();

        $startDate = $request->input('start_date', now()->subDays(7)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        if ($request->filled('filter')) {
            $filter = $request->input('filter');

            if ($filter === 'week') {
                $startDate = now()->subDays(7)->toDateString();
                $endDate = now()->toDateString();
            } elseif ($filter === 'month') {
                $startDate = now()->subMonth()->toDateString();
                $endDate = now()->toDateString();
            } elseif ($filter === 'year') {
                $startDate = now()->subYear()->toDateString();
                $endDate = now()->toDateString();
            }
        }

        $dailyTransactions = TransactionsProducts::select(
            DB::raw('DATE(date) as day'),
            DB::raw('COUNT(*) as total')
        )
            ->where('outlet_id', $user->outlet_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(date)'))
            ->pluck('total', 'day');

        $dailyDeliveries = Delivery::select(
            DB::raw('DATE(send_date) as day'),
            DB::raw('COUNT(*) as total')
        )
            ->where('from_outlet_id', $user->outlet_id)
            ->whereBetween('send_date', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(send_date)'))
            ->pluck('total', 'day');

        $transactionsData = [];
        $deliveriesData = [];
        $days = [];

        $start = Carbon::createFromFormat('Y-m-d', $startDate);
        $end = Carbon::createFromFormat('Y-m-d', $endDate);
        $period = CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            $formattedDate = $date->toDateString();
            $days[] = $formattedDate;
            $transactionsData[] = $dailyTransactions[$formattedDate] ?? 0;
            $deliveriesData[] = $dailyDeliveries[$formattedDate] ?? 0;
        }

        $startDateFormat = Carbon::parse($startDate)->format('d M Y');
        $endDateFormat = Carbon::parse($endDate)->format('d M Y');

        return view('dashboard.index', compact(
            'user',
            'role',
            'countProducts',
            'countDeliveries',
            'countTransactions',
            'countStokist',
            'name',
            'outlet',
            'chartInstance',
            'transactions',
            'deliveries',
            'transactionsData',
            'deliveriesData',
            'days',
            'startDateFormat',
            'endDateFormat'
        ))
            ->with('isAdmin', $user->role_id == 1)
            ->with('isPIC', $user->role_id == 2)
            ->with('isStaff', $user->role_id == 3);
    }

    public function filter(Request $request)
{
    $user = Auth::user();
    $outletId = $user->outlet_id;

    $filter = $request->filter ?? 'week';
    $endDate = Carbon::now();
    $startDate = match ($filter) {
        'week' => $endDate->copy()->subDays(6),
        'month' => $endDate->copy()->subMonth(),
        'year' => $endDate->copy()->subYear(),
        default => $endDate->copy()->subDays(6),
    };

    $labels = [];
    $deliveriesData = [];
    $transactionsData = [];

    if ($filter === 'week') {
        $period = CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $labels[] = $date->format('d M');
            $deliveriesData[] = Delivery::where('from_outlet_id', $outletId)
                ->whereDate('send_date', $date)
                ->count();

            $transactionsData[] = TransactionsProducts::where('outlet_id', $outletId)
                ->whereDate('date', $date)
                ->count();
        }
    } elseif ($filter === 'month') {
        $weekStart = $startDate->copy()->startOfWeek();
        while ($weekStart < $endDate) {
            $weekEnd = $weekStart->copy()->endOfWeek();
            $labels[] = $weekStart->format('d M') . ' - ' . $weekEnd->format('d M');

            $deliveriesData[] = Delivery::where('from_outlet_id', $outletId)
                ->whereBetween('send_date', [$weekStart, $weekEnd])
                ->count();

            $transactionsData[] = TransactionsProducts::where('outlet_id', $outletId)
                ->whereBetween('date', [$weekStart, $weekEnd])
                ->count();

            $weekStart->addWeek();
        }
    } elseif ($filter === 'year') {
        $startMonth = $startDate->copy()->startOfMonth();
        while ($startMonth < $endDate) {
            $endMonth = $startMonth->copy()->endOfMonth();
            $labels[] = $startMonth->format('M Y');

            $deliveriesData[] = Delivery::where('from_outlet_id', $outletId)
                ->whereBetween('send_date', [$startMonth, $endMonth])
                ->count();

            $transactionsData[] = TransactionsProducts::where('outlet_id', $outletId)
                ->whereBetween('date', [$startMonth, $endMonth])
                ->count();

            $startMonth->addMonth();
        }
    }

    return response()->json([
        'labels' => $labels,
        'deliveriesData' => $deliveriesData,
        'transactionsData' => $transactionsData,
        'startDate' => $startDate->format('d M Y'),
        'endDate' => $endDate->format('d M Y'),
    ]);
}


}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Products;
use App\Models\StokistReport;
use App\Models\StokistReportsDeliverDetail;
use App\Models\StokistReportsDetail;
use App\Models\StokistReportsProductDetail;
use App\Models\StokistReportsTransactionDetail;
use App\Models\TransactionsProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokistReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // $query = StokistReport::with(['stokist', 'stokist_report_details'])
        //     ->where('outlet_id', $user->outlet_id);

        $stokistReports = StokistReport::where('outlet_id', $user->outlet_id)
            ->paginate(10);

        $isAdmin = $user->role_id = 1;
        $isPIC = $user->role_id = 2;

        return view('dashboard.stokist_report.index', compact('stokistReports', 'isAdmin', 'isPIC'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'report_date_start' => 'required|date',
            'report_date_end' => 'required|date',
            'report_type' => 'required|in:harian,mingguan,bulanan,tahunan',
            'description' => 'nullable|string',
        ]);

        $stokistReport = StokistReport::create([
            'outlet_id' => $user->outlet_id,
            'division_id' => $user->division_id,
            'report_date_start' => $validated['report_date_start'],
            'report_date_end' => $validated['report_date_end'],
            'report_type' => $validated['report_type'],
            'created_by' => $user->id,
            'description' => $validated['description'],
        ]);

        $reportDate = now();
        $startDate = Carbon::parse($validated['report_date_start'])->startOfDay();
        $endDate = Carbon::parse($validated['report_date_end'])->endOfDay();

        $products = Products::where('outlet_id', $user->outlet_id)
            ->whereBetween('date_input', [$startDate, $endDate])
            ->get();

        $deliveries = Delivery::where('from_outlet_id', $user->outlet_id)
            ->whereBetween('send_date', [$startDate, $endDate])
            ->get();

        $transactions = TransactionsProducts::where('outlet_id', $user->outlet_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $stokistReportDetail = StokistReportsDetail::create([
            'stokist_report_id' => $stokistReport->id,
            'date' => $reportDate,
        ]);

        foreach ($products as $product) {
            StokistReportsProductDetail::create([
                'stokist_report_detail_id' => $stokistReportDetail->id,
                'product_id' => $product->id,
                'quantity' => $product->stock,
                'date' => $reportDate,
            ]);
        }

        foreach ($deliveries as $delivery) {
            StokistReportsDeliverDetail::create([
                'stokist_report_detail_id' => $stokistReportDetail->id,
                'deliveries_id' => $delivery->id,
                'date' => $reportDate,
            ]);
        }

        foreach ($transactions as $transaction) {
            StokistReportsTransactionDetail::create([
                'stokist_report_detail_id' => $stokistReportDetail->id,
                'transaction_id' => $transaction->id,
                'date' => $reportDate,
            ]);
        }

        return redirect()->back()->with('toast_success', 'Laporan Stokist berhasil dibuat.');
    }

    public function destroy($id)
    {
        $stokistReport = StokistReport::find($id);

        if (!$stokistReport) {
            return redirect()->back()->with('toast_error', 'Laporan Stokist tidak ditemukan.');
        }

        $reportDetails = StokistReportsDetail::where('stokist_report_id', $id)->get();

        foreach ($reportDetails as $detail) {
            StokistReportsProductDetail::where('stokist_report_detail_id', $detail->id)->delete();
            StokistReportsDeliverDetail::where('stokist_report_detail_id', $detail->id)->delete();
            StokistReportsTransactionDetail::where('stokist_report_detail_id', $detail->id)->delete();

            $detail->delete();
        }

        $stokistReport->delete();

        return redirect()->back()->with('toast_success', 'Laporan Stokist berhasil dihapus.');
    }

    public function detailStokist($id)
    {
        $stokistReport = StokistReport::find($id);

        if (!$stokistReport) {
            return redirect()->back()->with('toast_error', 'Laporan Stokist tidak ditemukan.');
        }

        $reportDetails = StokistReportsDetail::where('stokist_report_id', $id)->get();

        $detailIds = $reportDetails->pluck('id');

        $productDetails = StokistReportsProductDetail::whereIn('stokist_report_detail_id', $detailIds)->with('product')->get();
        $deliverDetails = StokistReportsDeliverDetail::whereIn('stokist_report_detail_id', $detailIds)->with('delivery')->get();
        $transactionDetails = StokistReportsTransactionDetail::whereIn('stokist_report_detail_id', $detailIds)->with('transactions')->get();

        return view('dashboard.stokist_report_detail.index', compact('stokistReport', 'reportDetails', 'productDetails', 'deliverDetails', 'transactionDetails'));
    }

}

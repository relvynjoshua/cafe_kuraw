<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class LogController extends Controller
{
    /**
     * Display a list of all logs with inventory and user data.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch the search query input
        $search = $request->input('search');

        // Fetch logs with relationships and apply search filters
        $logs = Log::with(['inventory', 'user'])
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('change_type', 'like', "%{$search}%")
                    ->orWhereHas('inventory', function ($q) use ($search) {
                        $q->where('item_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('firstname', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the logs view
        return view('dashboard.logs.index', compact('logs', 'search'));
    }


    public function exportPdf($timeframe = null)
    {
        $query = Log::with(['inventory', 'user']);

        // Filter logs based on the selected timeframe
        switch ($timeframe) {
            case 'daily':
                $query->whereDate('created_at', Carbon::today());
                $title = 'Daily Logs (' . Carbon::today()->toFormattedDateString() . ')';
                break;

            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                $title = 'Monthly Logs (' . Carbon::now()->format('F Y') . ')';
                break;

            case 'yearly':
                $query->whereYear('created_at', Carbon::now()->year);
                $title = 'Yearly Logs (' . Carbon::now()->year . ')';
                break;

            default:
                $title = 'All Logs';
                break;
        }

        $logs = $query->orderBy('created_at', 'desc')->get();

        // Generate the PDF
        $pdf = PDF::loadView('dashboard.logs.pdf', ['logs' => $logs, 'title' => $title]);

        // Return the PDF as a download
        return $pdf->download('inventory_logs_' . ($timeframe ?? 'all') . '.pdf');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Reports;
use App\Models\ReportTypes;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReportsController extends Controller
{
    public function index(): View
    {
        $reports = Reports::with(['type', 'order'])->paginate(10);
        $types = ReportTypes::all();
        $orders = Orders::all();
        return view('reports/index', compact('reports', 'types', 'orders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'type_id' => 'required|exists:report_types,id',
            'description' => 'nullable|string',
        ]);

        Reports::create([
            'order_id' => $request->order_id,
            'type_id' => $request->type_id,
            'description' => $request->description
        ]);

        return back()->with('status', 'Report Created Successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $report = Reports::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'type_id' => 'required|exists:report_types,id',
            'description' => 'nullable|string',
        ]);
        $report->update([
            'order_id' => $request->order_id,
            'type_id' => $request->type_id,
            'description' => $request->description
        ]);

        return back()->with('status', 'Report Updated Successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $report = Reports::findOrFail($id);
        $report->delete();

        return back()->with('status', 'Report Deleted Successfully');
    }
}

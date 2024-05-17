<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use App\Models\MediaPlans;
use App\Models\Orders;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaPlansController extends Controller
{
    public function index(): View
    {
        $mPlans = MediaPlans::with(['order', 'channel'])->get();
        $orders = Orders::all();
        $channels = Channels::all();
        return view('media_plans/index', compact('mPlans', 'orders', 'channels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'channels_id' => 'required|exists:channels,id',
        ]);

        MediaPlans::create([
            'order_id' => $request->order_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'channels_id' => $request->channels_id,
        ]);

        return back()->with('status', 'Media Plan Created Successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $mPlans = MediaPlans::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'channels_id' => 'required|exists:channels,id',
        ]);

        $mPlans->update([
            'order_id' => $request->order_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'channels_id' => $request->channels_id,
        ]);

        return back()->with('status', 'Media Plan Updated Successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $mPlans = MediaPlans::findOrFail($id);
        $mPlans->delete();

        return back()->with('status', 'Media Plan Deleted Successfully');
    }
}

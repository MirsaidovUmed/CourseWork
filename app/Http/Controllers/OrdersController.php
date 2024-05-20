<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderStatus;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return View
     */
    public function index(): View
    {
        $orders = Orders::with(['client', 'status', 'product'])->paginate(10);
        $clients = User::all();
        $statuses = OrderStatus::all();
        $products = Products::all();
        return view('orders.index', compact('orders', 'clients', 'statuses', 'products'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'clients_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'status_id' => 'required|exists:order_statuses,id',
            'product_id' => 'required|exists:products,id',
            'order_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Orders::create([
            'name' => $request->name,
            'clients_id' => $request->clients_id,
            'order_date' => $request->order_date,
            'status_id' => $request->status_id,
            'product_id' => $request->product_id,
            'order_price' => $request->order_price,
            'description' => $request->description,
        ]);

        return back()->with('status', 'Order Created Successfully');
    }

    /**
     * Update the specified order in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $order = Orders::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'clients_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'status_id' => 'required|exists:order_statuses,id',
            'product_id' => 'required|exists:products,id',
            'order_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $order->update([
            'name' => $request->name,
            'clients_id' => $request->clients_id,
            'order_date' => $request->order_date,
            'status_id' => $request->status_id,
            'product_id' => $request->product_id,
            'order_price' => $request->order_price,
            'description' => $request->description,
        ]);

        return back()->with('status', 'Order Updated Successfully');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return back()->with('status', 'Order Deleted Successfully');
    }
}

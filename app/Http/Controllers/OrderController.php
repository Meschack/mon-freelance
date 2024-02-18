<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(12);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * @var Service $service
         */

        $service = Service::query()->findOrFail($request->get('service'));

        /** @var Order $order */

        $order = Order::create([
            'service_id' => $service->id,
            'user_id' => auth()->id(),
            'price' => $service->price,
            'status' => 'pending'
        ]);

        dd($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchOrderRequest;
use App\Http\Requests\ReviewOrderRequest;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::query()->where('user_id', auth()->id());

        /**
         * @var User
         */
        $user = Auth::user();

        if ($user->role->name === 'seller' && $request->input('type') && $request->input('type') === 'customers') {
            $orders = $user->customersOrders();
        }

        if ($request->input('status')) {
            $orders = $orders->where('status', $request->input('status'));
        }

        $orders = $orders->orderBy('id', 'desc')->paginate(12)->withQueryString();

        // dd($orders);

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

        // send notification

        Notification::create([
            'user_id' => $order->service->user_id,
            'message' => Auth::user()->firstname . ' ' .  Auth::user()->lastname . ' have just ordered your service ' . $order->service->title . '.',
            'link' => "/order/" . $order->id
        ]);

        return redirect()->route('order.show', compact('order'))->with('success', 'Your order have been successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)

    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        $contact = $user->id === $order->user_id ? $order->service->user : $order->user;

        /**
         * @var Collection | array $messages
         */
        $messages = $user->messagesWithUser($contact->id);

        $content = is_array($messages) ? ($messages) : $messages->reverse();

        return view('orders.show', compact(['order', 'content', 'contact']));
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
    public function update(PatchOrderRequest $request, Order $order)
    {
        $data = ($request->validated());

        $newStatus = $data['action'] === 'done' ? 'done' : 'cancelled';

        $order->status = $newStatus;

        $order->save();

        // Create Notification

        Notification::create([
            'user_id' => auth()->id() === $order->user_id ? $order->service->user_id : $order->user_id,
            'message' => 'The order ' . $order->id . ' have just been ' . $newStatus . ' by ' . Auth::user()->firstname . ' ' .  Auth::user()->lastname . '.',
            'link' => "/order/" . $order->id
        ]);

        return redirect()->route('order.show', compact('order'))->with('success', 'The order is now' . $newStatus);
    }

    public function review(ReviewOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        // send a notification

        Notification::create([
            'user_id' => $order->service->user_id,
            'message' => Auth::user()->firstname . ' ' .  Auth::user()->lastname . ' have just left a review on the order ' . $order->id . '.',
            'link' => "/order/" . $order->id
        ]);

        return back()->with('success', 'Your review has been successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

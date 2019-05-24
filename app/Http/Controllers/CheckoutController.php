<?php

use App\Models\Order;
use App\Components\Tracking\TrackingInterface;

class CheckoutController extends Controller
{
    private $tracking;

    public function __construct(TrackingInterface $tracking)
    {
        $this->tracking = $tracking;
    }

    public function store(CheckoutRequest $request)
    {
        $order = Order::create($request->validated());

        $this->tracking->storeOrderInformation($order);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for order. Your code #' . $order->getKey()
        ]);
    }
}
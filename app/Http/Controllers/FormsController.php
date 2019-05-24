<?php

namespace App\Http\Controllers;

use App\Components\Tracking\TrackingInterface;

class FormsController extends Controller
{
    private $tracking;

    public function __construct(TrackingInterface $tracking)
    {
        $this->tracking = $tracking;
    }

    public function handleCallback(CallbackRequest $request)
    {
        //send to marketing systems

        $this->tracking->setName($request->get('name'));

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for request.'
        ]);
    }
}
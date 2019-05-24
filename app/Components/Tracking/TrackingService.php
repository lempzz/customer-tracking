<?php

namespace App\Components\Tracking;

use App\Models\{Order, CarModel};
use Symfony\Component\HttpFoundation\Cookie;

class TrackingService implements TrackingInterface
{
    const TRACKING_COOKIE_KEY = 'track_id';

    /**
     * @var UserTracking
    */
    protected $model;

    /**
     * @var DataScheme
    */
    protected $scheme;

    public function __construct()
    {
        $this->model = new UserTracking();
        $this->scheme = $this->model->getScheme();
    }

    public function set(UserTracking $analytic)
    {
        $this->model = $analytic;
        $this->scheme = $analytic->getScheme()->merge($this->scheme);
    }

    public function addGoogleId(string $id)
    {
        $this->scheme->addIfNotExists('ga', $id);
    }

    public function setCity(string $city)
    {
        $this->scheme->set('city', $city);
    }

    public function setName(string $name)
    {
        $this->scheme->set('name', $name);
    }

    public function cookie() : Cookie
    {
        return Cookie::create(
            TrackingService::TRACKING_COOKIE_KEY,
            $this->model->getKey(),
            date('c', strtotime('+5 year')),
            '/',
            null,
            false,
            false,
            true
        );
    }

    public function storeOrderInformation(Order $order)
    {
        if ($order->name) {
            $this->setName($order->name);
        }

        if ($order->city) {
            $this->setCity($order->city);
        }
    }

    public function save()
    {
        if ($this->model->exists) {
            $this->model->update([
                'data' => $this->scheme->toArray()
            ]);
        }
    }
}
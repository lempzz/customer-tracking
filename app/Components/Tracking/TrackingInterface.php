<?php

namespace App\Components\Tracking;

use Symfony\Component\HttpFoundation\Cookie;
use App\Models\{Order, CarModel};

interface TrackingInterface
{
    public function set(UserTracking $analytic);

    public function addCar(CarModel $model);

    public function addVinCar(CarModel $model, string $vin);

    public function addGoogleId(string $id);

    public function setName(string $name);

    public function setCity(string $city);

    public function cookie() : Cookie;

    public function storeOrderInformation(Order $order);

    public function save();
}
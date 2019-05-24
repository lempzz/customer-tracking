<?php

namespace App\Models\Order;

class CarModel extends Model
{
    public function getCarModification()
    {
        return $this->modification;
    }

    public function getVinNumber()
    {
        return $this->vin_number;
    }
}
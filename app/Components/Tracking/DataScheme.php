<?php

namespace App\Components\Tracking;

use App\Support\RawPayload;
use App\Models\CarModel;

class DataScheme extends RawPayload
{
    public static function createFromData(array $data)
    {
        return (new DataScheme())->setIfNotNull('garage', array_get($data, 'garage'))
            ->setIfNotNull('ga', array_get($data, 'ga'))
            ->setIfNotNull('city', array_get($data, 'city'))
            ->setIfNotNull('name', array_get($data, 'name'));
    }

    public function __construct()
    {
        $this->payload = [
            'garage' => [],
            'city' => '',
            'name' => '',
            'ga' => []
        ];
    }

    public function merge(DataScheme $scheme)
    {
        $this->set('garage', array_merge($this->get('garage'), $scheme->get('garage')));
        $this->set('ga', array_merge($this->get('ga'), $scheme->get('ga')));

        $this->setIfNotEmpty('city', $scheme->get('city'));
        $this->setIfNotEmpty('name', $scheme->get('name'));

        return $this;
    }

    public function toArray()
    {
        return $this->payload;
    }

    public function __toString()
    {
        return json_encode($this->payload);
    }
}
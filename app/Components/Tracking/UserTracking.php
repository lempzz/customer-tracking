<?php

namespace App\Components\Tracking;

use Symfony\Component\HttpFoundation\Cookie;

class UserTracking extends Model
{
    /**
     * @var UserTracking[] $resolved
    */
    protected static $resolved = [];

    protected $attributes = [
        'data' => '{}'
    ];
    protected $casts = [
        'data' => 'array'
    ];

    public function getScheme() : DataScheme
    {
        return DataScheme::createFromData($this->data);
    }

    public static function make($number)
    {
        return static::$resolved[$number] = UserTracking::create([
            'tel' => only_number($number),
            'data' => (new DataScheme())->toArray()
        ]);
    }

    public static function phone($number) : UserTracking
    {
        $number = only_number($number);

        if (!array_key_exists($number, static::$resolved)) {
            static::$resolved[$number] = UserTracking::query()
                ->where('phone', $number)
                ->firstOr(function () use ($number) {
                    return UserTracking::make($number);
                });
        }

        return static::$resolved[$number];
    }
}

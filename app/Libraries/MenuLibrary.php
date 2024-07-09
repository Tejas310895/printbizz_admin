<?php

namespace App\Libraries;

class MenuLibrary
{
    public static function get_menu($role = null)
    {

        $list = [
            'dashboard' => '/',
            'orders' => [
                'overview' => 'orders-index'
            ],
            'products' => [
                'Products' => 'products-index',
                'Itemnary' => 'products-itemnary',
            ],
            'customers' => [
                'List' => 'customers-index',
            ],
            'institutions' => [
                'List' => 'institutions-index',
            ],
            'Partners' => [
                'List' => 'partners-index',
            ],
            'Coupon' => [
                'List' => 'coupon-index',
            ]
        ];

        return $list;
    }
}

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
            'Customers' => [
                'List' => 'customers-index',
            ]
        ];

        return $list;
    }
}

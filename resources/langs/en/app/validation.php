<?php

return [

    'name_required'                             => 'name is required',
    'name_min'                                  => 'name must be at least 3 charachters',
    'name_max'                                  => 'name must not be more than 3 charachters',
    'phone_required'                            => 'phone is required',
    'phone_unique'                              => 'this phone is used for another account , enter another phone',
    'country_code_required'                     => 'country code is required',
    'city_id_required'                          => 'city_id is required',
    'city_id_exists'                            => 'city_id not exists',
    'mobile_id_required'                        => 'mobile id is required',
    'mobile_id_in'                              => 'mobile id must be equal to 0 or 1',
    'id_required'                               => 'id is required',
    'id_numeric'                                => 'id must be a number',

    'product_id_required'               => 'product_id is required',
    'product_id_exists'                 => 'product_id not exists',
    'options_id_array'                  => 'options_id must be array',
    'qty_required'                      => 'qty is required',
    'qty_numeric'                       => 'qty must be a number',
    'qty_min'                           => 'qty is must not lower than 1',

    'cart_id_required'              => 'cart_id is required',
    'cart_id_numeric'               => 'cart_id must ba a number',
    'cart_id_exists'                => 'cart_id not exists',

    'user_id_required'                  => 'user_id is required',
    'user_id_required_if'               => 'user_id is required if driver_id is empty',
    'user_id_exists'                    => 'user_id not exists',
    'driver_id_required'                => 'driver_id is required',
    'driver_id_required_if'             => 'driver_id is required if user_id is empty',
    'driver_id_exists'                  => 'driver_id not exists',
    'message_required'                  => 'message is required',
    'user_is_sender_required'           => 'user_is_sender is required',
    'user_is_sender_between'            => 'user_is_sender must be in 0 or 1',
    'chat_id_required'                  => 'chat_id is required',
    'chat_id_exists'                    => 'chat_id not exists',

    'user_location_id_required'         => 'user_location_id is required',
    'user_location_id_exists'           => 'user_location_id not exists',
    'payment_type_required'             => 'payment_type is required',
    'payment_type_in'                   => 'payment_type must equal to 1 or 2 or 3',
    'user_lng_required'                 => 'user_lng is required',
    'user_lat_required'                 => 'user_lat is required',
    'user_location_map_required'        => 'user_location_map is required',
    'points_discount_in'                => 'points_discount must equal to 0 or 1',

    'driver_id_numeric'         => 'driver_id must be a number',
    'driver_stars_required'     => 'driver_stars is required',
    'driver_stars_numeric'      => 'driver_stars must be a number',
    'driver_stars_min'          => 'driver_stars value must not lower than 1',
    'driver_stars_max'          => 'driver_stars value must not greater than 5',
    'order_id_required'         => 'order_id is required',
    'order_id_numeric'          => 'order_id must be a number',
    'order_id_exists'           => 'order_id not exists',
    'order_stars_required'      => 'order_stars is required',
    'order_stars_numeric'       => 'order_stars must be a number',
    'order_stars_min'           => 'order_stars value must not lower than 1',
    'order_stars_max'           => 'order_stars value must not greater than 5',
    'note_max'                  => 'note length must not greater than 191 charachters',

    'longitude_required'    => 'longitude is required',
    'longitude_min'         => 'longitude length must not lower than 1 charachters',
    'longitude_max'         => 'longitude length must not greater than 191 charachters',
    'latitude_required'     => 'latitude is required',
    'latitude_min'          => 'latitude length must not lower than 1 charachters',
    'latitude_max'          => 'latitude length must not greater than 191 charachters',


    // '' => '',







];

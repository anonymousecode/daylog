<?php

/*
 * This file is part of the Laravel Cloudinary package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'cloud'   => env('CLOUDINARY_CLOUD_NAME'),
    'key'     => env('CLOUDINARY_API_KEY'),
    'secret'  => env('CLOUDINARY_API_SECRET'),
    'secure'  => env('CLOUDINARY_SECURE', true),
    // You can keep your extra keys as needed
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),

    // Optional extras for your widget:
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    'upload_route'  => env('CLOUDINARY_UPLOAD_ROUTE'),
    'upload_action' => env('CLOUDINARY_UPLOAD_ACTION'),
];

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'service' => 'KINSTUDIOS',
        'version' => 'V1',
        'docs' => url('/docs/api'),
    ]);
});

<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $direccionesDeCorreo = DB::table('suscripcions')
        ->whereNotNull('hash')
        ->where('created_at', '<=', now()->subDays(30))->get();

    foreach ($direccionesDeCorreo as $direccion)
    {
        Notification::route('mail', $direccion->correo)
            ->notify(new \App\Notifications\sendSubscriptionDeleteNotification());
    }

    DB::table('suscripcions')
        ->whereNotNull('hash')
        ->where('created_at', '<=', now()->subDays(30))
        ->delete();
})->daily();

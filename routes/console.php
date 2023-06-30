<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('cpy', function () {
    $chunks = collect(File::allFiles(public_path('/')))->chunk(50);

    $chunks->each(function ($chunk) {
        $chunk->each(function ($file) {
            $filePath = $file->getPathname();
            $destinationPath = $file->getRelativePathname();
            Storage::disk('s3')->put($destinationPath, File::get($filePath), 'public');
        });
    });
});

Artisan::command('dbi', function () {
    // DB::unprepared('DROP TABLE IF EXISTS `admin_menu_items`;');
    // DB::unprepared('DROP TABLE IF EXISTS `admin_menus`;');
    // DB::unprepared('DROP TABLE IF EXISTS `migrations`;');
    // DB::unprepared('DROP TABLE IF EXISTS `password_resets`;');
    // DB::unprepared('DROP TABLE IF EXISTS `users`;');
    // DB::unprepared('DROP TABLE IF EXISTS `products`;');
    // DB::unprepared('DROP TABLE IF EXISTS `payment_types`;');
    // DB::unprepared('DROP TABLE IF EXISTS `zones`;');
    // DB::unprepared('DROP TABLE IF EXISTS `suppliers`;');
    // DB::unprepared('DROP TABLE IF EXISTS `stores`;');
    // DB::unprepared('DROP TABLE IF EXISTS `stocks`;');
    // DB::unprepared('DROP TABLE IF EXISTS `sliders`;');
    // DB::unprepared('DROP TABLE IF EXISTS `settings`;');
    // DB::unprepared('DROP TABLE IF EXISTS `roles`;');
    // DB::unprepared('DROP TABLE IF EXISTS `purchases`;');
    // DB::unprepared('DROP TABLE IF EXISTS `categories`;');
    // DB::unprepared('DROP TABLE IF EXISTS `category_product`;');
    // DB::unprepared('DROP TABLE IF EXISTS `cities`;');
    // DB::unprepared('DROP TABLE IF EXISTS `countries`;');
    // DB::unprepared('DROP TABLE IF EXISTS `customers`;');
    // DB::unprepared('DROP TABLE IF EXISTS `failed_jobs`;');
    // DB::unprepared('DROP TABLE IF EXISTS `invoices`;');
    // DB::unprepared('DROP TABLE IF EXISTS `media`;');
    // DB::unprepared('DROP TABLE IF EXISTS `media_product`;');
    // DB::unprepared('DROP TABLE IF EXISTS `notifications`;');
    // DB::unprepared('DROP TABLE IF EXISTS `order_products`;');
    // DB::unprepared('DROP TABLE IF EXISTS `orders`;');
    // DB::unprepared('DROP TABLE IF EXISTS `pages`;');
    // DB::unprepared('DROP TABLE IF EXISTS `payment_compeltes`;');
    // DB::unprepared('DROP TABLE IF EXISTS `payments`;');
    // DB::unprepared('DROP TABLE IF EXISTS `couriers`;');

    DB::unprepared(file_get_contents(base_path('db.sql')));
});

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
    DB::unprepared(file_get_contents(base_path('db.sql')));
});

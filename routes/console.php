<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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
})->purpose('Display an inspiring quote');
Artisan::command('remove:controller {name : Name of the controller}', function ($name) {

    // File location
    $file_location = base_path() . '/app/Http/Controllers/Admin/' . $name . '.php';
    $this->comment($file_location);

    // Check if exist
    if (file_exists($file_location)) {
        exec('rm ' . $file_location);
        $this->info($name.' has been deleted!');
    } else {
        $this->error('Cannot delete ' . $name . ', file not found.');
    }

})->describe('Remove spesific controller');


Artisan::command('remove:model {name : Name of the Model}', function ($name) {

    // File location
    $file_location = base_path() . '/app/Models/' . $name . '.php';

    // Check if exist
    if (file_exists($file_location)) {
        exec('rm' . $file_location);
        $this->info($name.' has been deleted!');
    } else {
        $this->error('Cannot delete ' . $name . ', file not found.');
    }

})->describe('Remove spesific model');
Artisan::command('remove:middleware {name : Name of the Middleware}', function ($name) {

    // File location
    $file_location = base_path() . '/app/Http/Middleware/' . $name . '.php';

    // Check if exist
    if (file_exists($file_location)) {
        exec('rm ' . $file_location);
        $this->info($name.' has been deleted!');
    } else {
        $this->error('Cannot delete ' . $name . ', file not found.');
    }

})->describe('Remove spesific Middleware');
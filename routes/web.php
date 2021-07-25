<?php

use App\Http\Controllers\CsvUploadAction;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->view('/', 'welcome');

$router->view('/dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

$router->post('/dashboard', CsvUploadAction::class)
    ->middleware(['auth'])
    ->name('csv.upload');

require __DIR__.'/auth.php';

<?php declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\CsvUploadAction;
use App\Support\File\CsvParser;
use App\Support\File\DataParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CsvUploadAction::class)
            ->needs(DataParser::class)
            ->give(CsvParser::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

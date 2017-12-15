<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Traits\CommonTrait;

use App\Statistic;
use Carbon\Carbon;

use App\Warning;
use App\Tournament;
use App\Picture;
use App\Contact;
use App\Guest;

class ViewComposerServiceProvider extends ServiceProvider
{
    use CommonTrait;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.master', function ($view) {
            $this->guestInformation();
            // $view->with([
            //     'randompictures' => Picture::firstsrandompicture()->get(),
            //     'warnings' => Warning::showwarning()->get(),
            //     'warnings' => Warning::where('id', 999)->get(),
            //     'ozoirTounaments' => Tournament::ozoirfuturetournament()->get(),
            //     'otherTournaments' => Tournament::otherfuturetournament()->get(),
            //     'onlineguest' => Guest::onlineguest(),
            //     'stat' => Statistic::first()
            // ]);
            $view->with([
                'onlineguest' => Guest::onlineguest(),
                'stat' => Statistic::first()
            ]);
        });

        view()->composer('errors::404', function ($view) {
            $this->guestInformation();
            $view->with([
                'randompictures' => Picture::firstsrandompicture()->get(),
                'warnings' => Warning::showwarning()->get(),
                'ozoirTounaments' => Tournament::ozoirfuturetournament()->get(),
                'otherTournaments' => Tournament::otherfuturetournament()->get(),
                'onlineguest' => Guest::onlineguest(),
                'stat' => Statistic::first()
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

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
use App\MediaLink;

use App\Partner;
use App\ContentInformation;

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
            $warningbefore = Warning::showwarning();
            $allwarnings = Warning::showwarningbetween()->union($warningbefore)->orderBy('id')->get();
            $year = intval($this->yearSeason());
            $season = $year . "-" . ($year + 1);

            $view->with([
                'onlineguest' => Guest::onlineguest(),
                'stat' => Statistic::first(),
                'randompictures' => Picture::firstsrandompicture()->get(), 
                'warnings' => $allwarnings, 
                'ozoirTounaments' => Tournament::ozoirfuturetournament()->get(), 
                'otherTournaments' => Tournament::otherfuturetournament()->get(), 
                'partnerAds' => Partner::inRandomOrder()->get(), 
                'season' => $season, 
                'logo' => ContentInformation::where('name', 'logo image')->first(),
                'banner' => ContentInformation::where('name', 'banniere image')->first(),
                'music_link' => ContentInformation::where('name', 'musique de fond')->first(),
                'music_volume' => ContentInformation::where('name', 'volume musique')->first(),
                'fb_img' => ContentInformation::where('name', 'facebook image')->first(),
                'fb_link' => ContentInformation::where('name', 'facebook url')->first(),
                'title_list_tournament_1' => ContentInformation::where('name', 'image tournament 1')->first(),
                'title_list_tournament_2' => ContentInformation::where('name', 'image tournament 2')->first(),
                'medialinks' => MediaLink::all(),
                'map' => ContentInformation::where('name', 'map')->first()
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

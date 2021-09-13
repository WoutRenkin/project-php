<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use View;
use App\AcademyYear;
use App\Session;
use DateTime;
use App\DatabaseChannel;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel);

        if (App::environment('production')) {
            URL::forceScheme('https');
        }
        View::composer(['shared.navstudents'], function($view) {

            $academyYear = AcademyYear::where('active', 1)->first();
            $navinfo = Auth::user()->StudentAcademyYears()->where('academy_year_id', $academyYear->id)->first();
            $session = Session::where('academy_year_id', $academyYear->id)->where('team_id', $navinfo->team_id)->first();
            $checkDate = new DateTime();

            if($session){
                $timeSession = Carbon::parse($session->date_time);
                if ($timeSession <= $checkDate   && $session->status_id === 3) {
                    $navinfo["session"] = $session;
                } else {
                    $navinfo["session"] = null;
                }
            } else {
                $navinfo["session"] = null;
            }


            $view->with('user', $navinfo);
        });

        View::composer(['shared.navigation', 'shared.notificationnav'], function($view) {

            $academyYear = AcademyYear::where('active', 1)->first();

            $view->with('academyYear', $academyYear);
        });
        //
    }
}

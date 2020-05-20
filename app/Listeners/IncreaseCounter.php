<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VideoViewer;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if(!session()->has('videoIsVisited')){

            $this -> updateViewer($event->video);

        }else{

            return false;
        }

    }


     function updateViewer($video){

        $video -> viewers = ($video -> viewers) + 1 ;
        $dataVideo =  $video ->save();

        session()->put('videoIsVisited',$video->id);

    }


}

<?php

use Carbon\Carbon;

if(!function_exists('messageDestroyedByTime'))
{
    function messageDestroyed(){
        try{
            $currentTimestamp = Carbon::now()->timestamp;
            return \App\Message::query()->where('duration','<=',$currentTimestamp)->delete();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
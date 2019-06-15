<?php

if(!function_exists('messageDestroyedByTime'))
{
    function messageDestroyed(){
        try{
            return \App\Message::query()->delete();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\Message;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MessageRepository extends BaseRepository
{
    public function model()
    {
        return Message::class;
    }

    public function createMessage($data)
    {
        try {
            $data['ip_addr'] = request()->ip();
            $data['is_read'] = "0";
            $data['user_type'] = (isset(auth()->user()->id) && !empty(auth()->user()->id) )? "1" :"0";

            if(isset($data['password']) && !empty($data['password']))
                $data['password'] = encrypt($data['password']);

            $data['content'] = encrypt($data['content']);
            $data['token'] =(string) Str::uuid();
            $data['duration'] = now()->addMinute($data['duration'])->timestamp;
            unset($data['_token']);

            $message = $this->create($data);

            if(auth()->user()) {
                auth()->user()->messages()->attach($message);
            }
            return ['status' => true, "data" => $message];

        } catch (Exception  $ex) {

            return ['status' => false, "message" => $ex->getMessage()];
        }
    }


    public function updateMessage($token, $data)
    {
        try {
            $message = $this->where('token',$token)->first();

            if($message) {
                $message->content = encrypt($data['content']);
                $message->save();
            }
            
            return ['status' => true, "data" => $message];
        } catch (Exception  $ex) {
            return ['status' => false, "message" => $ex->getMessage()];
        }
    }


    public function getAllMessage($params = ["*"])
    {
        return $this->where("id", auth()->user()->id )->get($params);
    }

    public function getMessageByField($value, $column = "id" )
    {
        try{
            $message =  $this->getByColumn($value, $column);
            return ['status' => true, "data" => $message];
        } catch (Exception  $ex) {
            return ['status' => false, "message" => $ex->getMessage()];
        }
    }

    public function deleteMessageByField($value, $column = "id" )
    {
        try{
            $current=  $this->getMessageByField($value, $column);

            if(!$current['status']) {
                throw new \Exception("Something went wrong to delete message. Please try after some time.");
            }
            if(auth()->user()) {
                auth()->user()->messages()->detach($current['data']->id);
            }
            $message = $this->deleteById($current['data']->id);
            return ['status' => true, "data" => $message];
        } catch (Exception  $ex) {
            return ['status' => false, "message" => $ex->getMessage()];
        }
    }

    public function getMessageByToken($token)
    {
        try {
            $response = $this->where('token',$token)->first();

            if($response) {
                $message = decrypt($response->content);
                if((!auth()->user()) && $response->isPrivate == '0' ){
                    $response->delete();
                    $response= '';
                }
                return view('message.message-view',compact('message','response'));
            } else {

                $message = 'This message not longer available';
                $response= '';
                return view('message.message-view',compact('message','response'));
            }

        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            $message = '';
            $response= '';
            return view('message.message-view',compact('message', 'response'));
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function createMessageWithoutStore($request)
    {
        try {
            $data = [];
            $token = (string) Str::uuid();
            $data['content'] = $request->content ?? '';
            $data['duration'] = now()->addMinute($request->duration)->timestamp ?? '';
            $data['token'] = $token;

            return ['status' => true, "data" => encrypt(json_encode($data))];

        } catch (\Exception $ex) {
            $ex->getMessage();
        }

    }
}

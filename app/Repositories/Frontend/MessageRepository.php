<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\Message;
use Exception;
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
                auth()->user()->messages()->sync($message);
            }
            return ['status' => true, "data" => $message];

        } catch (Exception  $ex) {

            return ['status' => false, "message" => $ex->getMessage()];
        }
    }


    public function updateMessage($id, $data)
    {
        try {
            $user = $this->updateById($id, $data);
            return ['status' => true, "data" => $user];
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
                throw new \Exception("Something went wrong to edit message. Please try after some time.");
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
                return view('message.message-view',compact('message'));
            } else {

                $message = 'This message not longer available';
                return view('message.message-view',compact('message'));
            }

        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());

            $message = 'This message not longer available';
            return view('message.message-view',compact('message'));
        }
    }
}

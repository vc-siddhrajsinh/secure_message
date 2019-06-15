<?php

namespace App\Repositories\Frontend;

use App\Repositories\BaseRepository;
use App\Message;
use Exception;

class MessageRepository extends BaseRepository
{
    public function model()
    {
        return Message::class;
    }

    public function createMessage($data)
    {
        try {
            $user = $this->create($data);
            return ['status' => true, "data" => $user];
        } catch (Exception  $ex) {
            dd($ex->getMessage());
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

    public function getMessagePaginate($request, $params = ["*"],  $limit = 15, $page = 1)
    {
        return $this->where("id", auth()->user()->id )->paginate($limit, $params, "page", $page);
    }
}

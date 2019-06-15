<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStore;
use App\Http\Requests\MessageUpdate;
use App\Repositories\Frontend\MessageRepository;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    protected $message;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth')->except("readMessage", "guestLogin", "store", "create");
        $this->message = $message;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $message = $this->message->getAllMessage();
        return view('message.home')->withMessage($message ?? []);
    }

    public function guestLogin()
    {
        return view('message.guestIndex');
    }


    public function readMessage(Request $request)
    {
        return view('message.read');
    }

    public function store(MessageStore $request)
    {
        try {
            $message = $this->message->createMessage($request->all());
            if (!$message['status']) {
                throw new \Exception("Something went wrong to create message. Please try after some time.");
            }
            if (auth()->user()) {
                return redirect()->route("frontend.messages.index")->withFlashSuccess("Message created successfully.");
            }
            return redirect()->route("frontend.guest.login")->withFlashSuccess("Message created successfully.")->withMessage($message['data']);
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }

    public function update(MessageUpdate $request, $id)
    {
        try {
            $message = $this->message->updateMessage($id, $request->all());
            return redirect()->route("frontend.messages.index")->withFlashSuccess("Message updates successfully.");
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }


    public function create()
    {
        return view('message.create');
    }

    public function edit(Request $request, $id)
    {
        try {
            $message = $this->message->getMessageByField($id, "token");
            if (!$message['status']) {
                throw new \Exception("Something went wrong to edit message. Please try after some time.");
            }
            return view('message.edit')->withMessage($message);
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }

    }

    public function destroy(Request $request, $id)
    {
        try {
            $message = $this->message->deleteMessageByField($id, "token");
            if (!$message['status']) {
                throw new \Exception("Something went wrong to edit message. Please try after some time.");
            }
            return view('message.edit')->withMessage($message);
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }
}

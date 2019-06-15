<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStore;
use App\Http\Requests\MessageUpdate;
use App\Message;
use App\Repositories\Frontend\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $message;

    /**
     * MessageController constructor.
     * @param MessageRepository $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth')->except("readMessage", "guestLogin", "store", "create", "show");
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        try {
            $message = auth()->user()->messages;

            return view('message.home')->withMessages($message ?? []);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return abort(404);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guestLogin($token)
    {
        return view('message.guestIndex',compact('token'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function readMessage(Request $request)
    {
        return view('message.read');
    }

    /**
     * @param MessageStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageStore $request)
    {
        try {
            if(auth()->user()) {
                $message = $this->message->createMessage($request->all());
                if (!$message['status']) {
                    throw new \Exception("Something went wrong to create message. Please try after some time.");
                }
                return redirect()->route("frontend.messages.index")->withFlashSuccess("Message created successfully.");
            }
            $message = $this->message->createMessageWithoutStore($request);

            return redirect()->route("frontend.guest.login",[$message['data']]);
        } catch (\Exception $ex) {

            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @param MessageUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MessageUpdate $request, $id)
    {
        try {
            $message = $this->message->updateMessage($id, $request->all());
            return redirect()->route("frontend.messages.index")->withFlashSuccess("Message updates successfully.");
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('message.create')->withEdit(false);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        try {
            $message = $this->message->getMessageByField($id, "token");
            if (!$message['status']) {
                throw new \Exception("Something went wrong to edit message. Please try after some time.");
            }
            return view('message.edit')->withMessage($message['data'])->withEdit(true);;
        } catch (\Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show($token)
    {
        try {
            if(auth()->user()){
                return $this->message->getMessageByToken($token);
            }

        }catch (\Exception $ex) {
            \Log::error($ex->getMessage());

            return abort(404);
        }

    }
}

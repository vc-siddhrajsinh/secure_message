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
    public function guestLogin()
    {
        return view('message.guestIndex');
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
            $message = $this->message->createMessage($request->all());
            if (!$message['status']) {
                throw new \Exception("Something went wrong to create message. Please try after some time.");
            }
            if (auth()->user()) {
                return redirect()->route("frontend.messages.index")->withFlashSuccess("Message created successfully.");
            }
            return redirect()->route("frontend.guest.login")->withFlashSuccess("Message created successfully.")->withMessage($message['data']);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
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
            \Log::error($ex->getMessage());
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        try{
            return view('message.create')->withEdit(false);
        }catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return abort(404);
        }

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
            \Log::error($ex->getMessage());
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
            if(!$request->ajax()){
                return redirect()->route("frontend.messages.index")->withErrors("This actions not allowed.");
            }
            $message = $this->message->deleteMessageByField($id, "token");
            if (!$message['status']) {
                throw new \Exception("Something went wrong to delete message. Please try after some time.");
            }
            return response()->json(['status'=> true, "message" => "Message deleted successfully."]);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return response()->json(['status'=> false, "message" => $ex->getMessage()]);
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show($token)
    {
        try {

            return $this->message->getMessageByToken($token);
        }catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return abort(404);
        }

    }
}

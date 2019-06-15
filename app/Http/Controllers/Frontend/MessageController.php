<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStore;
use App\Http\Requests\MessageUpdate;
use App\Repositories\Frontend\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $this->middleware('auth')->except("readMessage" ,"guestLogin","store");
        $this->message = $message;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $message =  $this->message->getAllMessage();
        return view('message.home')->withMessage($message ?? []);
    }

    public function guestLogin()
    {
        return view('message.create');
    }

    public function readMessage(Request $request)
    {
        return view('message.read');
    }

    public function store(MessageStore $request)
    {
        try{

            $data = $request->all();
            $data['ip_addr'] = request()->ip();
            $data['is_read'] = "0";
            $data['user_type'] = (isset(auth()->user()->id) && !empty(auth()->user()->id) )? "1" :"0";

            if(isset($request->password) && !empty($request->password))
                $data['password'] = encrypt($request->password);

            $data['content'] = encrypt($request->content);
            $data['token'] =(string) Str::uuid();
            $data['duration'] = now()->addMinute($request->duration)->timestamp;
            unset($data['_token']);

            $message = $this->message->createMessage($data);


            if(!$message['status'])
            {
                throw new \Exception("Something went wrong to create message. Please try after some time.");
            }

            return redirect()->route("frontend.messages.index")->withFlashSuccess("Message created successfully.");
        } catch (\Exception $ex)
        {
            return back()->withErrors($ex->getMessage());
        }
    }

    public function update(MessageUpdate $request)
    {
        try{

            return redirect()->route("frontend.messages.index")->withFlashSuccess("Message updates successfully.");
        } catch (\Exception $ex)
        {
            return back()->withErrors($ex->getMessage());
        }
    }


    public function create()
    {
        return view('message.create');
    }

    public function edit()
    {
        return view('message.edit');
    }

    public function destroy()
    {
        return view('message.edit');
    }
}

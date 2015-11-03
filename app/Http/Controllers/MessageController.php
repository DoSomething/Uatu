<?php

  namespace App\Http\Controllers;
  use Validator;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\View;
  use App\Message;

  class MessageController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $messages = Message::all();

      return View::make('messages.index')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      return View::make('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $rules = array(
        'type'          => 'required',
        'message'       => 'required',
        'short_term'    => 'required',
        'long_term'     => 'required',
      );

      $validator = Validator::make($request->all(), $rules);

      // process the form.
      if ($validator->fails()) {
        return redirect('messages/create')
          ->withErrors($validator)
          ->withInput();
      }
      else {
        // store
        $message = new Message;
        $message->type          = $request->input('type');
        $message->message       = $request->input('message');
        $message->exact         = $request->input('exact');
        $message->short_term    = $request->input('short_term');
        $message->long_term     = $request->input('long_term');
        $message->has_sentiment = $request->input('has_sentiment');
        $message->save();

        // redirect
        $request->session()->flash('status', 'Successfully created message!');
        return redirect('messages');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $message = Message::find($id);

      return View::make('messages.show')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $message = Message::find($id);

      return View::make('messages.edit')->with('message', $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $rules = array(
        'type'          => 'required',
        'message'       => 'required',
        'short_term'    => 'required',
        'long_term'     => 'required',
      );

      $validator = Validator::make($request->all(), $rules);

      // process the form.
      if ($validator->fails()) {
        return redirect('messages/' . $id . '/edit')
          ->withErrors($validator)
          ->withInput();
      }
      else {
        // store
        $message = Message::find($id);
        // dd($message);
        $message->type          = $request->input('type');
        $message->message       = $request->input('message');
        $message->exact         = $request->input('exact');
        $message->short_term    = $request->input('short_term');
        $message->long_term     = $request->input('long_term');
        $message->has_sentiment = $request->input('has_sentiment');
        $message->save();

        // redirect
        $request->session()->flash('status', 'Message updated!');
        return redirect('messages');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
      //
    }
  }

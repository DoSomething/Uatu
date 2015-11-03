<?php

  namespace App\Http\Controllers;
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
    public function store()
    {
      //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
      //
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

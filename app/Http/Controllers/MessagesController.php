<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function index()
    {
        return View('profile.messages');
    }

    public function store(Request $request)
    {
        dd(true);
    }

    public function show($id)
    {
        return View('profile.messages-chat',['id_chat'=>$id]);
    }
}

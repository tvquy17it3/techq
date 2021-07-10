<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{

    public function index_room()
    {
        return View('profile.messages');
    }

    public function store(Request $request)
    {
        dd(true);
    }

    public function show_room($id)
    {
        return View('profile.messages-chat',['id_chat'=>$id]);
    }
}

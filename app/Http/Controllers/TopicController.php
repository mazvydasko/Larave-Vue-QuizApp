<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function all() {

        $topics = Topic::all();
        $topics->load('questions.options');

        return response()->json(["topics" => $topics], 200);
    }


    public function get($id) {

        $topic = Topic::whereId($id)->first();

        return response()->json(["topic" => $topic], 200);
    }

    public function edit(Request $request) {

        $topic = Topic::findOrFail($request->id);
        $topic->title = $request->input('title');
        $topic->save();

        return response()->json(["topic" => $topic], 200);
    }


    public function new(Request $request)
    {
        $topic = new Topic();
        $topic->title = $request->input('title');
        $topic->save();


        return response()->json(["topic" => $topic], 200);
    }

    public function delete($id) {

        $topic = Topic::findOrFail($id);
        $topic->delete();

        return response()->json(null);
    }
}

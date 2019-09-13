<?php

namespace App\Http\Controllers;

use App\Result;
use App\UserOption;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function all()
    {

        $results = Result::orderBy('created_at', 'desc')->get();
        $results->load('user');

        return response()->json(["results" => $results], 200);
    }


    public function new(Request $request)
    {
        $result = new Result();

        $result->user_id = auth('api')->user()->id;
        $result->topic_id = $request->input('topic_id');
        $result->correct_answers = $request->input('correct_answers');
        $result->questions_count = $request->input('questions_count');
        $result->save();

        $array = $request->input('user_picks');

        foreach ($array as $key => $value) {
            $userOption = new UserOption();
            $userOption->user_id = auth('api')->user()->id;
            $userOption->result_id = $result->id;
            $userOption->question_id = $value['question_id'];
            $userOption->topic_id = $request->input('topic_id');
            $userOption->option_id = $value['option_id'];
            $userOption->save();
        }

        return response()->json(["result" => $result], 200);
    }
}

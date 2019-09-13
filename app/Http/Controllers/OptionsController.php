<?php

namespace App\Http\Controllers;

use App\Options;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function all() {

        $answers = Options::orderBy('created_at', 'desc')->get();
        $answers->load('question');

        return response()->json(["answers" => $answers], 200);
    }

    public function edit(Request $request) {

        $option = Options::find($request->input('id'));
        $option->question_id = $request->input('question_id');
        $option->option = $request->input('answer_option');
        $option->correct = $request->input('correct');
        $option->save();

        return response()->json(["option" => $option], 200);
    }

    public function delete($id) {

        $option = Options::findOrFail($id);
        $option->delete();

        return response()->json(null);
    }
}

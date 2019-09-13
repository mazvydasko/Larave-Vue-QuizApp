<?php

namespace App\Http\Controllers;

use App\Options;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function all() {

        $questions = Question::orderBy('created_at', 'desc')->get();
        $questions->load('topic');

        return response()->json(["questions" => $questions], 200);
    }

    public function new(Request $request) {

        $topicID = $request->input('topic_id');
        $questionText = $request->input('question');
        $optionArray = $request->input('answers');

        $question = new Question();
        $question->topic_id = $topicID;
        $question->question_text = $questionText;
        $question->save();

        $questionToAdd = Question::latest()->first();;
        $questionID = $questionToAdd->id;

        foreach ($optionArray as $index => $opt) {
            $option = new Options();
            $option->question_id = $questionID;
            $option->option = $opt['answer'];
            $option->correct = $opt['correct'];
            $option->save();
        }

        return response()->json(["question" => $question], 200);
    }

    public function edit(Request $request) {

        $question = Question::find($request->input('id'));
        $question->topic_id = $request->input('topic_id');
        $question->question_text = $request->input('question');
        $question->save();

        return response()->json(["question" => $question], 200);
    }

    public function delete($id) {

        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(null);
    }
}

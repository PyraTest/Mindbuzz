<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Choices;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\RevisionQuestionsBank;
use App\Models\Test;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
   //  Questions
   public function getQuestions()
   {
       $questions = Question::paginate(3);
       return view('dashboard.question.index')->with("questions", $questions);
   }
   public function createQuestion()
   {
       $tests = Test::all();
       return view('dashboard.question.create', compact("tests"));
   }
   public function addQuestion(Request $request)
   {
       $number = +1;
       while (Question::where('number', $number)->exists()) {
           $number++;
       }

       $data = $request->except(['_token', 'choice_ans', 'choice']);
       $data['number'] = $number;
       $question = Question::create($data);
       if ($request->type == 1) {
           foreach ($request->choice as $index => $choice) {
               $new_choice = new Choices();
               $new_choice->question_id = $question->id;
               $new_choice->choice = $choice;


               switch ($request->choice_ans) {
                   case 'a':
                       if ($index == 0) {
                           $new_choice->answer_flag = 1;
                       } else
                           $new_choice->answer_flag = 0;
                       break;
                   case 'b':
                       if ($index == 1) {
                           $new_choice->answer_flag = 1;
                       } else
                           $new_choice->answer_flag = 0;
                       break;
                   case 'c':
                       if ($index == 2) {
                           $new_choice->answer_flag = 1;
                       } else
                           $new_choice->answer_flag = 0;
                       break;
                   case 'd':
                       if ($index == 3) {
                           $new_choice->answer_flag = 1;
                       } else
                           $new_choice->answer_flag = 0;
                       break;
               }

               $new_choice->save();
           }
       }


       DB::commit();

       return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
   }
   public function editQuestion($id)
   {
       $questions = Question::findOrFail($id);
       $tests = Test::all();
       return view('dashboard.question.edit', compact("tests"))->with("questions", $questions);
   }
   public function updateQuestion(Request $request, $id)
   {

       $questions = Question::findOrFail($id);
       $data = $request->except('_token');
       $questions->update($data);

       return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
   }
   public function deleteQuestion(Request $request, $id)
   {
       try {
           $question = Question::findOrFail($id);
           $question->delete();

           if ($request->ajax()) {
               return response()->json(['success' => __('admin/forms.deleted_successfully')]);
           } else {
               return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
           }
       } catch (ModelNotFoundException $e) {
           // Handle the case where the record with the given ID does not exist
           if ($request->ajax()) {
               return response()->json(['error' => __('admin/forms.not_found')], 404);
           } else {
               return redirect()->back()->with(['error' => __('admin/forms.not_found')]);
           }
       }
   }

   // End Questions

    

}
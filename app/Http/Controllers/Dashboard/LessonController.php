<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonEnding;
use App\Models\Test;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    public function storeUnitLesson(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unit_id' => 'required',
            'warmup_id' => 'required',
        ]);
        $number = +1;
        while (Lesson::where('number', $number)->exists()) {
            $number++;
        }

        $data = $request->except('_token');
        $data['number'] = $number;
        Lesson::create($data);
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }

     //  lesson Endings
     public function getLessonEndings()
     {
         $lessonEndings = LessonEnding::paginate(25);
         return view('dashboard.lesson-endings.index')->with("lessonEndings", $lessonEndings);
     }
     public function createLessonEnding()
     {
         $lessons = Lesson::all();
         $tests = Test::all();
         $homeworks = Test::where("type", 2)->get();
         return view('dashboard.lesson-endings.create', compact(["lessons", 'tests', 'homeworks']));
     }
     public function addLessonEnding(Request $request)
     {
         $data = $request->except('_token');
         $lessonEndings = LessonEnding::create($data);
 
         DB::commit();
 
         return redirect()->route("admin.lesson-endings")->with(['success' => __('admin/forms.added_successfully')]);
     }
     public function editLessonEnding($id)
     {
         $lessonEndings = LessonEnding::findOrFail($id);
         $lessons = Lesson::all();
         $tests = Test::all();
         $homeworks = Test::where("type", 2)->get();
         return view('dashboard.lesson-endings.edit', compact(["lessons", "tests", "homeworks"]))->with("lessonEndings", $lessonEndings);
     }
     public function updateLessonEnding(Request $request, $id)
     {
 
         $lessonEndings = LessonEnding::findOrFail($id);
         $data = $request->except('_token');
         $lessonEndings->update($data);
 
         return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
     }
     public function deleteLessonEnding(Request $request, $id)
     {
         try {
             $lessonEndings = LessonEnding::findOrFail($id);
             $lessonEndings->delete();
 
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
 
     // End lesson Endings

     
}
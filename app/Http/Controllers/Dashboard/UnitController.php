<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\UnitBeginning;
use App\Models\Lesson;
use App\Models\Presentation;
use App\Models\Warmup;
use App\Models\LessonEnding;
use App\Models\UnitEnding;
use App\Models\Test;
use App\Models\QuestionBank;
use App\Models\UnitCheckpoint;
use Illuminate\Support\Facades\DB;


class UnitController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    //  Units Start
    public function getUnits()
    {
        $units = Unit::orderBy("program_id")->paginate(25);
        return view('dashboard.unit.index', compact(['units']));
    }

    public function getUnitBeginning($id)
    {
        $beginnings = UnitBeginning::where('unit_id', $id)->paginate(25);
        return view('dashboard.unit.beginning.index', compact(['beginnings', 'id']));
    }

    public function getUnitLessons($id)
    {
        $lessons = Lesson::where('unit_id', $id)->paginate(25);
        return view('dashboard.unit.lesson.index', compact(['lessons', 'id']));
    }
    public function getPresentation($id)
    {
        $presentations = Presentation::where('lesson_id', $id)->get();
        return view('dashboard.unit.lesson.presentation.index', compact(['presentations', 'id']));
    }
    public function getLessonWarmup($id)
    {
        $lesson = Lesson::with('warmup')->find($id);
        $warmups = Warmup::where('id', $lesson->warmup_id)->get();
        return view('dashboard.unit.lesson.lesson-warmup.index', compact(['warmups', 'id']));
    }
    public function getEndOfLesson($id)
    {
        $lessonEndings = LessonEnding::where('lesson_id', $id)->get();
        return view('dashboard.unit.lesson.lesson-ending.index', compact(['lessonEndings', 'id']));
    }




    public function getUnitEnding($id)
    {
        $endings = UnitEnding::where('unit_id', $id)->paginate(25);
        return view('dashboard.unit.ending.index', compact(['endings', 'id']));
    }
    public function createUnitEnding($id)
    {
        $warmups = Warmup::get();
        $tests = Test::get();
        $units = Unit::get();
        $banks = QuestionBank::get();
        // $data = $request->except('_token');
        // $endings = UnitEnding::create($data);
        return view('dashboard.unit.ending.create', compact(['warmups', 'tests', 'units', 'banks', 'id']));
    }
    public function storeUnitEnding(Request $request)
    {

        $data = $request->except('_token');
        $endings = UnitEnding::create($data);
        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function showUnitEnding($id)
    {
        $endings = UnitEnding::findOrFail($id);
        return view('dashboard.unit.ending.show', compact(['endings', 'id']));
    }
    public function showUnitViewBeginning($id)
    {
        $beginnings = UnitBeginning::findOrFail($id);
        return view('dashboard.unit.beginning.show', compact(['beginnings', 'id']));
    }


    public function getUnitCheckpoint($id)
    {
        $checkpoints = UnitCheckpoint::where('unit_id', $id)->paginate(25);
        return view('dashboard.unit.checkpoint.index', compact(['checkpoints', 'id']));
    }



    public function createUnitCheckpoint($id)
    {
        $units = Unit::get();
        $tests = Test::get();
        $banks = QuestionBank::get();

        return view('dashboard.unit.checkpoint.create', compact(['tests', 'units', 'banks', 'id']));
    }
    public function storeUnitCheckpoint(Request $request)
    {
        // $number = +1;
        $data = $request->except('_token');
        $test = UnitCheckpoint::where("unit_id", $request->unit_id)->orderBy("number", "desc")->first();
        $number = $test ? $test->number + 1 : 1;
        $data['number'] = $number;
        $checkpoint = UnitCheckpoint::create($data);
        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function showUnitCheckpoint($id)
    {
        $checkpoints = UnitCheckpoint::findOrFail($id);
        return view('dashboard.unit.checkpoint.show', compact(['checkpoints', 'id']));
    }

    public function editUnitCheckpoint($id)
    {
        $checkpoints = UnitCheckpoint::findOrFail($id);
        $units = Unit::get();
        $tests = Test::get();
        $banks = QuestionBank::get();
        return view('dashboard.unit.checkpoint.edit', compact(['units', 'tests', 'banks']))->with("checkpoints", $checkpoints);
    }
    public function updateUnitCheckpoint(Request $request, $id)
    {
        $checkpoints = UnitCheckpoint::findOrFail($id);
        $data = $request->except('_token');
        $checkpoints->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }

    public function deleteUnitCheckpoint(Request $request, $id)
    {
        try {
            $checkpoints = UnitCheckpoint::findOrFail($id);
            $checkpoints->delete();

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
        // $units = Unit::findOrFail($id);
        // $units->delete();
        // return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
    }
    public function createUnit()
    {
        $programs = Program::all();
        return view('dashboard.unit.create')->with("programs", $programs);
    }
    public function createUnitBeginning($id)
    {
        $tests = Test::all();
        return view('dashboard.unit.beginning.create', compact(['tests', 'id']));
    }
    public function createUnitLesson($id)
    {
        $lessons = Lesson::all();
        $units = Unit::all();
        $warmups = Warmup::all();
        return view('dashboard.unit.lesson.create', compact(['lessons', 'units', 'id', 'warmups']));
    }
    public function storeUnitBeginning(Request $request)
    {
        // |mimes:mp4,mov,avi,wmv,avchd,webm,flv
        $rules = [];
        $request->validate([
            'test_id' => 'required',
            'video' => 'required',
            'doc' => 'required|mimes:doc,pdf,docx,ppt,pptx,txt',
            'test' => 'required|mimes:doc,pdf,docx,ppt,pptx,txt',
        ]);

        $data = $request->except('_token', 'doc', 'test');
        $beginning = UnitBeginning::create($data);

        $beginning->doc = $this->upploadImage($request->doc, 'uploads/documents');
        $beginning->test = $this->upploadImage($request->test, 'uploads/assignments');
        $beginning->update();
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editUnit($id)
    {
        $units = Unit::findOrFail($id);
        $programs = Program::all();
        return view('dashboard.unit.edit', compact("programs"))->with("units", $units);
    }
    public function updateUnit(Request $request, $id)
    {
        $units = Unit::findOrFail($id);
        $data = $request->except('_token');
        $units->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }

    public function deleteUnit(Request $request, $id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->delete();

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
        // $units = Unit::findOrFail($id);
        // $units->delete();
        // return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
    }

    // Add unit
    public function addUnit(Request $request)
    {

        $rules = [];

        $number = +1;
        while (Unit::where('number', $number)->where('program_id', $request->program_id)->exists()) {
            $num = Unit::where('program_id', $request->program_id)->orderBy('id', 'desc')->first()->number;
            $number = $num + 1;
        }
        $data = $request->except('_token');
        $data["number"] = $number;
        $unit = Unit::create($data);
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    // Unit end

}

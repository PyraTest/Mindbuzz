<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Advertisment;
use App\Models\SalonReserve;
use App\Models\Transaction;
use App\Models\Sliders;
use App\Models\Program;
use App\Models\School;
use App\Models\Course;
use App\Models\Stage;
use App\Models\Privacy;
use App\Models\Test;
use App\Models\Unit;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    public function index()
    {
        $schools = School::all();
        return view('dashboard.index', compact(['schools']));
    }

    public function addProgram(Request $request)
    {

        $data = $request->except('_token');
        $program = Program::create($data);

        // save photo category
        // if ($request->hasFile('icon')) {
        //     $city->icon = $this->upploadImage($request->File('icon'), 'assets/images/cities/');
        //     $city->save();
        // } // end of upload photo

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }

    public function getPrograms()
    {
        $programs = Program::with(['school', 'course', 'stage'])->paginate(3);
        return view('dashboard.program.index', compact(['programs']));
    }
    public function createProgram()
    {
        $courses = Course::all();
        $stages = Stage::all();
        $schools = School::all();
        return view('dashboard.program.create', compact(['courses', 'stages', 'schools']));
    }
    public function createSchool()
    {
        return view('dashboard.school.create');
    }
    public function createCourse()
    {
        return view('dashboard.course.create');
    }
    public function createStage()
    {
        return view('dashboard.stage.create');
    }
    //  Units
    public function getUnits()
    {
        $units = Unit::paginate(3);
        return view('dashboard.unit.index', compact(['units']));
    }
    public function createUnit()
    {
        $programs = Program::all();
        return view('dashboard.unit.create')->with("programs", $programs);
    }
    public function editUnit($id)
    {
        $units = Unit::findOrFail($id);
        return view('dashboard.unit.edit')->with("units", $units);
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
    //  Units

    //  Tests
    public function getTests()
    {
        $tests = Test::paginate(3);
        return view('dashboard.test.index')->with("tests", $tests);
    }
    public function createTest()
    {
        return view('dashboard.test.create');
    }
    public function addTest(Request $request)
    {

        $rules = [];
        $request->validate([
            'type' => 'required|in:' . implode(',', [Test::TYPE_TEST, Test::TYPE_QUIZ, Test::TYPE_HOMEWORK]),
        ]);

        $data = $request->except('_token');
        $test = Test::create($data);
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editTest($id)
    {
        $tests = Test::findOrFail($id);
        return view('dashboard.test.edit')->with("tests", $tests);
    }
    public function updateTest(Request $request, $id)
    {
        $tests = Test::findOrFail($id);
        $data = $request->except('_token');
        $tests->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }

    public function deleteTest(Request $request, $id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->delete();

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

    //  Tests




    public function addSchool(Request $request)
    {

        $rules = [];


        $data = $request->except('_token');
        $school = School::create($data);
        // save photo category
        // if ($request->hasFile('icon')) {
        //     $city->icon = $this->upploadImage($request->File('icon'), 'assets/images/cities/');
        //     $city->save();
        // } // end of upload photo

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function addStage(Request $request)
    {

        $rules = [];


        $data = $request->except('_token');
        $stage = Stage::create($data);
        // save photo category
        // if ($request->hasFile('icon')) {
        //     $city->icon = $this->upploadImage($request->File('icon'), 'assets/images/cities/');
        //     $city->save();
        // } // end of upload photo

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function addCourse(Request $request)
    {

        $rules = [];


        $data = $request->except('_token');
        $course = Course::create($data);
        // save photo category
        // if ($request->hasFile('icon')) {
        //     $city->icon = $this->upploadImage($request->File('icon'), 'assets/images/cities/');
        //     $city->save();
        // } // end of upload photo

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    // Add unit
    public function addUnit(Request $request)
    {

        $rules = [];


        $data = $request->except('_token');
        $unit = Unit::create($data);
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }

    public function getSchools()
    {
        $schools = School::paginate(3);
        return view('dashboard.school.index', compact(['schools']));
    }
    public function getCourses()
    {
        $courses = Course::paginate(3);
        return view('dashboard.course.index', compact(['courses']));
    }
    public function getStages()
    {
        $stages = Stage::paginate(3);
        return view('dashboard.stage.index', compact(['stages']));
    }




    public function destroy_city($id)
    {
        try {
            $city = Cities::find($id);
            if (!$city)
                return redirect()->route('admin.cities')->with(['error' => 'هذه القسم غير موجوده']);


            // deleteFile($city->icon, 'assets/images/categories/');
            $city->delete();
            CitiesTranslation::where('city_id', $id)->delete();

            return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of destroy

}

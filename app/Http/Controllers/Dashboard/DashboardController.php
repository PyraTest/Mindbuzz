<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Advertisment;
use App\Models\Beginning;
use App\Models\Benchmark;
use App\Models\SalonReserve;
use App\Models\Transaction;
use App\Models\Sliders;
use App\Models\Program;
use App\Models\School;
use App\Models\Course;
use App\Models\Ending;
use App\Models\Stage;
use App\Models\Privacy;
use App\Models\Question;
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
        $tests = Test::find($id);

        if (!$tests) {
            return redirect()->route('tests')->with('error', 'Test not found');
        }

        $types = Test::distinct('type')->pluck('type');

        return view('dashboard.test.edit', compact('tests', 'types'));
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

    //  End Tests



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

        $data = $request->except('_token');
        $question = Question::create($data);

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


    //  Benchmarks
    public function getBenchmarks()
    {
        $benchmarks = Benchmark::paginate(3);
        return view('dashboard.benchmark.index')->with("benchmarks", $benchmarks);
    }
    public function createBenchmark()
    {
        $programs = Program::all();
        $tests = Test::all();
        return view('dashboard.benchmark.create', compact("tests", "programs"));
    }
    public function addBenchmark(Request $request)
    {

        $data = $request->except('_token');
        $benchmark = Benchmark::create($data);

        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editBenchmark($id)
    {
        $benchmarks = Benchmark::findOrFail($id);
        $programs = Program::all();
        $tests = Test::all();

        return view('dashboard.benchmark.edit', compact("programs", "tests"))->with("benchmarks", $benchmarks);
    }
    public function updateBenchmark(Request $request, $id)
    {

        $benchmarks = Benchmark::findOrFail($id);
        $data = $request->except('_token');
        $benchmarks->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }
    public function deleteBenchmark(Request $request, $id)
    {
        try {
            $benchmark = Benchmark::findOrFail($id);
            $benchmark->delete();

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

    // End Benchmarks

    //  endings
    public function getEndings()
    {
        $endings = Ending::paginate(3);
        return view('dashboard.ending.index')->with("endings", $endings);
    }
    public function createEnding()
    {
        $programs = Program::all();
        $tests = Test::all();
        return view('dashboard.ending.create', compact("tests", "programs"));
    }
    public function addEnding(Request $request)
    {


        $data = $request->except('_token');
        $ending = Ending::create($data);

        DB::commit();

        return redirect()->route("admin.endings")->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editEnding($id)
    {
        $endings = Ending::findOrFail($id);
        $programs = Program::all();
        $tests = Test::all();

        return view('dashboard.ending.edit', compact("programs", "tests"))->with("endings", $endings);
    }
    public function updateEnding(Request $request, $id)
    {

        $endings = Ending::findOrFail($id);
        $data = $request->except('_token');
        $endings->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }
    public function deleteEnding(Request $request, $id)
    {
        try {
            $ending = Ending::findOrFail($id);
            $ending->delete();

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

    // End endings


    //  beginnings
    public function getBeginnings()
    {
        $beginnings = Beginning::paginate(3);
        return view('dashboard.beginning.index')->with("beginnings", $beginnings);
    }
    public function createBeginning()
    {
        $programs = Program::all();
        $tests = Test::all();
        return view('dashboard.beginning.create', compact("tests", "programs"));
    }
    public function addBeginning(Request $request)
    {


        $data = $request->except('_token');
        if ($request->hasFile('doc')) {
            $documentationFile = $request->file('doc');
            $documentationFileName = time() . "-" . "documentation" . '.' . $documentationFile->getClientOriginalExtension();
            $documentationFile->move(public_path('assets/upload/documentation_files'), $documentationFileName);
        }
        if ($request->hasFile('test')) {
            $testFile = $request->file('test');
            $testFileName = time() . "-" . "test" . '.' . $testFile->getClientOriginalExtension();
            $testFile->move(public_path('assets/upload/test_files'), $testFileName);
        }
        $data['doc'] = $documentationFileName;
        $data['test'] = $testFileName;

        $beginning = Beginning::create($data);

        DB::commit();

        return redirect()->route("admin.beginnings")->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editBeginning($id)
    {
        $beginnings = Beginning::findOrFail($id);
        $programs = Program::all();
        $tests = Test::all();

        return view('dashboard.beginning.edit', compact("programs", "tests"))->with("beginnings", $beginnings);
    }
    public function updateBeginning(Request $request, $id)
    {

        $beginnings = Beginning::findOrFail($id);
        $data = $request->except('_token');

        $documentationFileName = null;
        $testFileName = null;

        if ($request->hasFile('doc')) {
            $documentationFile = $request->file('doc');
            $documentationFileName = time() . "-" . "documentation" . '.' . $documentationFile->getClientOriginalExtension();
            $documentationFile->move(public_path('assets/upload/documentation_files'), $documentationFileName);
            $data['doc'] = $documentationFileName;
        }
        if ($request->hasFile('test')) {
            $testFile = $request->file('test');
            $testFileName = time() . "-" . "test" . '.' . $testFile->getClientOriginalExtension();
            $testFile->move(public_path('assets/upload/test_files'), $testFileName);
            $data['test'] = $testFileName;
        }
        $beginnings->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }
    public function deleteBeginning(Request $request, $id)
    {
        try {
            $beginning = Beginning::findOrFail($id);
            $beginning->delete();

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

    // End beginnings


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

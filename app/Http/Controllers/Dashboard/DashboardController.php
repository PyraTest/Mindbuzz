<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;

use App\Models\Program;
use App\Models\QuestionBank;
use App\Models\RevisionQuestionsBank;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Beginning;
use App\Models\Benchmark;



use App\Models\School;
use App\Models\Course;
use App\Models\Ending;
use App\Models\Stage;
use App\Models\Warmup;
use App\Models\Privacy;
use App\Models\Question;
use App\Models\WarmupTest;
use App\Models\WarmupVideos;
use App\Models\Test;
use App\Models\Unit;
use App\Models\UnitBeginning;
use App\Models\UnitEnding;
use App\Models\Choices;
use App\Models\Lesson;
use App\Models\LessonEnding;
use App\Models\Presentation;
use App\Models\UnitCheckpoint;
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

    

    

    public function deleteCourse(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

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
    public function deleteStage(Request $request, $id)
    {
        try {
            $stage = Stage::findOrFail($id);
            $stage->delete();

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
    public function getWarmups()
    {
        $warmups = Warmup::join('warmup_videos', 'warmups.id', 'warmup_videos.warmup_id')
            ->join('warmup_tests', 'warmups.id', 'warmup_tests.warmup_id')
            ->join('tests', 'warmup_tests.test_id', 'tests.id')
            ->select('*', 'warmups.id as id')
            ->get();
        return view('dashboard.unit.lesson.warmup.index', compact(["warmups"]));
    }
    public function createWarmup()
    {
        $tests = Test::all();
        return view('dashboard.unit.lesson.warmup.create', compact(['tests']));
    }
    
    public function addWarmup(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'doc' => 'required|mimes:doc,pdf,docx,ppt,pptx,txt',
            'test_id' => 'required',
            'video' => 'required',
        ]);
        $warmup = new Warmup();
        $warmup->name = $request->name;
        $warmup->doc = $this->upploadImage($request->doc, 'uploads/documents');
        // $warmup->doc = $request->doc;
        $warmup->save();

        $warmuptest = new WarmupTest;
        $warmuptest->warmup_id = $warmup->id;
        $warmuptest->test_id = $request->test_id;
        $warmuptest->save();

        $warmup_video = new WarmupVideos;
        $warmup_video->video = $request->video;
        $warmup_video->warmup_id = $warmup->id;
        $warmup_video->save();
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
    }


    //  End Tests



    


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
        $number = +1;
        while (Benchmark::where('number', $number)->exists()) {
            $number++;
        }
        $data = $request->except('_token');
        $data['number'] = $number;
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

   

    //  Presentations
    public function getPresentations()
    {
        $presentations = Presentation::paginate(3);
        return view('dashboard.presentation.index')->with("presentations", $presentations);
    }
    public function createPresentation()
    {
        $lessons = Lesson::all();
        return view('dashboard.presentation.create', compact("lessons"));
    }
    public function addPresentation(Request $request)
    {


        $data = $request->except('_token');
        $presentations = Presentation::create($data);

        DB::commit();

        return redirect()->route("admin.presentations")->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function editPresentation($id)
    {
        $presentations = Presentation::findOrFail($id);
        $lessons = Lesson::all();

        return view('dashboard.presentation.edit', compact("lessons"))->with("presentations", $presentations);
    }
    public function updatePresentation(Request $request, $id)
    {

        $presentations = Presentation::findOrFail($id);
        $data = $request->except('_token');
        $presentations->update($data);

        return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
    }
    public function deletePresentation(Request $request, $id)
    {
        try {
            $presentation = Presentation::findOrFail($id);
            $presentation->delete();

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

    // End Presentations

   

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

//  Revision questions
public function getRevisionQuestion()
{
    $revisionQuestions = RevisionQuestionsBank::paginate(3);
    return view('dashboard.revision-question.index')->with("revisionQuestions", $revisionQuestions);
}
public function createRevisionQuestion()
{
    $questionBanks = QuestionBank::all();
    return view('dashboard.revision-question.create', compact("questionBanks"));
}
public function addRevisionQuestion(Request $request)
{
    $number = +1;
    while (RevisionQuestionsBank::where('number', $number)->exists()) {
        $number++;
    }



    $data = $request->except('_token');
    $data['number'] = $number;
    $revisionQuestion = RevisionQuestionsBank::create($data);


    DB::commit();
    return redirect()->route("admin.create_revision_question")->with(['success' => __('admin/forms.added_successfully')]);
}
public function createQuestionBank(Request $request)
{

    $data = $request->except('_token');
    $questionBank = QuestionBank::create($data);
    return redirect()->route("admin.create_revision_question")->with(['success' => __('admin/forms.added_successfully')]);
}
public function getQuestionBanks()
{
    $questionBanks = QuestionBank::all();

    return response()->json($questionBanks);
}

public function editRevisionQuestion($id)
{
    $revisionQuestions = RevisionQuestionsBank::findOrFail($id);

    return view('dashboard.revision-question.edit')->with("revisionQuestions", $revisionQuestions);
}
public function updateRevisionQuestion(Request $request, $id)
{

    $revisionQuestions = RevisionQuestionsBank::findOrFail($id);
    $data = $request->except('_token');
    $revisionQuestions->update($data);

    return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
}
public function deleteRevisionQuestion(Request $request, $id)
{
    try {
        $revisionQuestion = RevisionQuestionsBank::findOrFail($id);
        $revisionQuestion->delete();

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

// End revision Question

}
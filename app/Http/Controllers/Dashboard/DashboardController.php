<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\QuestionBank;
use App\Models\RevisionQuestionsBank;
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
    //  Units Start
    public function getUnits()
    {
        $units = Unit::paginate(3);
        return view('dashboard.unit.index', compact(['units']));
    }

    public function getUnitBeginning($id)
    {
        $beginnings = UnitBeginning::where('unit_id', $id)->paginate(3);
        return view('dashboard.unit.beginning.index', compact(['beginnings', 'id']));
    }

    public function getUnitLessons($id)
    {
        $lessons = Lesson::where('unit_id', $id)->paginate(3);
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


    public function getUnitCheckpoint($id)
    {
        $checkpoints = UnitCheckpoint::where('unit_id', $id)->paginate(3);
        return view('dashboard.unit.checkpoint.index', compact(['checkpoints', 'id']));
    }

    public function getUnitEnding($id)
    {
        $endings = UnitEnding::where('unit_id', $id)->paginate(3);
        return view('dashboard.unit.ending.index', compact(['endings', 'id']));
    }
    // Unit end


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
    //  Units

    //  Tests
    public function getWarmups()
    {
        $warmups = Warmup::join('warmup_videos', 'warmups.id', 'warmup_videos.warmup_id')
            ->join('warmup_tests', 'warmups.id', 'warm
            up_tests.warmup_id')
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
    public function storeUnitLesson(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'unit_id' => 'required',
            'warmup_id' => 'required',
        ]);

        $data = $request->except('_token');
        Lesson::create($data);
        DB::commit();

        return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
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

        $data = $request->except(['_token','choice_ans','choice']);
        $question = Question::create($data);
        if($request->type == 1){
            foreach($request->choice as $index => $choice){
                $new_choice = new Choices();
                $new_choice->question_id = $question->id;
                $new_choice->choice = $choice;
                
                
                switch($request->choice_ans){
                    case 'a':
                        if($index == 0){
                            $new_choice->answer_flag = 1;
                        }else
                        $new_choice->answer_flag = 0;
                        break;
                    case 'b':
                        if($index == 1){
                            $new_choice->answer_flag = 1;
                        }else
                        $new_choice->answer_flag = 0;
                        break;
                    case 'c':
                        if($index == 2){
                            $new_choice->answer_flag = 1;
                        }else
                        $new_choice->answer_flag = 0;
                        break;
                    case 'd':
                        if($index == 3){
                            $new_choice->answer_flag = 1;
                        }else
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
        // $bankId = +1;
        // while (QuestionBank::where('id', $bankId)->exists()) {
        //     // If it exists, increment and check again
        //     $bankId++;
        // }
        // $Id = QuestionBank::create(['id' => $bankId]);



        $data = $request->except('_token');
        $revisionQuestion = RevisionQuestionsBank::create($data);


        DB::commit();
        return redirect()->route("admin.revision-question")->with(['success' => __('admin/forms.added_successfully')]);
    }
    public function createQuestionBank(Request $request)
    {
        $questionBank = new QuestionBank();
        $questionBank->save();

        return response()->json(['id' => $questionBank->id, 'success' => __('admin/forms.added_successfully')]);
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

    //  lesson Endings
    public function getLessonEndings()
    {
        $lessonEndings = LessonEnding::paginate(3);
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

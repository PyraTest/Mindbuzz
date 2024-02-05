<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Stage;
use App\Models\School;
use App\Models\Course;
use App\Models\Unit;
use App\Models\Benchmark;
use App\Models\Beginning;
use App\Models\BenchmarkAssignTo;
use App\Models\Ending;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
class ProgramController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    // Program journy
    public function addProgram(Request $request)
    {

        $data = $request->except('_token');
        $program = Program::create($data);

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
    public function showProgram($id)
    {
        $programs = Program::find($id);
        $units = BenchmarkAssignTo::orderBy('unit_id')
            ->orderBy('benchmark_id')
                ->get()
            ->groupBy('benchmark_id');

        return view('dashboard.program.show', compact(['programs', 'units']));
    }
    public function showProgramUnits($id)
    {
        $units = Unit::where("program_id", $id)->get();
        return view('dashboard.program.units.index', compact(['units']));
    }
    public function showProgramViewUnit($id)
    {
        $units = Unit::findOrFail($id);
        return view('dashboard.program.units.show', compact(['units']));
    }

    public function showProgramBenchmarks($id)
    {
        $benchmarks = Benchmark::where("program_id", $id)->get();
        return view('dashboard.program.benchmarks.index', compact(['benchmarks']));
    }
    public function showProgramBeginnings($id)
    {
        $beginnings = Beginning::where("program_id", $id)->get();
        return view('dashboard.program.beginnings.index', compact(['beginnings', 'id']));
    }
    public function showProgramViewBeginning($id)
    {
        $beginnings = Beginning::findOrFail($id);
        return view('dashboard.program.beginnings.show', compact(['beginnings', 'id']));
    }
    public function showProgramViewBenchmark($id)
    {
        $benchmarks = Benchmark::findOrFail($id);
        return view('dashboard.program.benchmarks.show', compact(['benchmarks', 'id']));
    }
    public function showProgramViewEnding($id)
    {
        $endings = Ending::findOrFail($id);
        return view('dashboard.program.endings.show', compact(['endings', 'id']));
    }
    public function showProgramEndings($id)
    {
        $endings = Ending::where("program_id", $id)->get();
        // dd($units);
        return view('dashboard.program.endings.index', compact(['endings', 'id']));
    }
    public function deleteProgram(Request $request, $id)
    {
        try {
            $program = Program::findOrFail($id);
            $program->delete();

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

    // End Program journy


}
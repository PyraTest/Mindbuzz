<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    
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
            'name' => 'required|max:16',
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

}
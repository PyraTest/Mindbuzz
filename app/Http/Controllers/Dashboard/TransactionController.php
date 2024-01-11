<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\{Transaction};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'DESC')->paginate(15);

        return view('dashboard.trans.index', compact(['transactions']));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create



    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $lang = [];
            // foreach (config('translatable.locales') as $one_lang) {
            //     // $lang += [$one_lang . '.name' => 'required|min:2|max:100'];
            //     $lang += [$one_lang . '.name' => 'required|min:2|max:100|unique:category_translations,name'];
            // }
            // $lang += [
            //     'icon'     => 'required|image',
            // ];
            // $data = $this->validate($request, $lang);

            $category = Category::create($request->all());

            // save photo category
            if ($request->hasFile('icon')) {
                $category->icon = $this->upploadImage($request->File('icon'), 'assets/images/cats/');
                $category->save();
            } // end of upload photo

            DB::commit();

            return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of store


    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category)
            return redirect()->route('admin.categories')->with(['error' => 'هذه القسم غير موجوده']);

        return view('dashboard.categories.edit', compact(['category']));
    } // end of edit


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'هذه القسم غير موجوده']);

            //validation
            $rules = [];
            foreach (array_keys(config('laravellocalization.supportedLocales')) as $locale) {
                $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
            }
            $rules += [
                // 'app_ratio' => 'required|numeric',
                'icon'     => 'nullable|image',
            ];

            $data = $this->validate($request, $rules);


            $old_icon_name = $category->icon;
            $category->update($data);

            if ($request->hasFile('icon')) {
                // dd($request->all(), $id, $category->icon);
                // $this->deleteFile($old_icon_name, 'assets/images/cats/');
                $category->icon = $this->upploadImage($request->File('icon'), 'assets/images/cats/');
                $category->save();
            } // end of upload photo


            DB::commit();
            return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of update


    public function changeStatus($id)
    {
        $category            = Category::findOrFail($id);
        $category['is_active']  = !$category['is_active'];
        $category->save();
        return redirect()->back();
    } // end of changeStatus


    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.categories')->with(['error' => 'هذه القسم غير موجوده']);


            $this->deleteFile($category->icon, 'assets/images/categories/');
            $category->delete();
            CategoryTranslation::where('category_id', $id)->delete();

            return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of destroy
}

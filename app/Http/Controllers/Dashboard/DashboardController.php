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
use App\Models\Privacy;
use App\Traits\backendTraits;
use App\Traits\HelpersTrait;
class DashboardController extends Controller
{
    use HelpersTrait;
    use backendTraits;
    public function index()
    {
        $schools = School::all();
        return view('dashboard.index',compact(['schools']));
    }
   
    public function addProgram(Request $request){
        try {
            DB::beginTransaction();

            $rules = [];

            $data = $this->validate($request, $rules);
            $city = Cities::create($data);

            // save photo category
            // if ($request->hasFile('icon')) {
            //     $city->icon = $this->upploadImage($request->File('icon'), 'assets/images/cities/');
            //     $city->save();
            // } // end of upload photo

            DB::commit();

            return redirect()->back()->with(['success' => __('admin/forms.added_successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    }
    
    public function getPrograms(){
        $programs = Program::paginate(3);
        return view('dashboard.program.index',compact(['programs']));
    }
    public function createProgram(){
        return view('dashboard.program.create');
    }
    public function createSchool(){
        return view('dashboard.school.create');
    }
    public function addSchool(Request $request){

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
    public function getSchools(){
        $schools = School::paginate(3);
        return view('dashboard.school.index',compact(['schools']));
    }
   
   
    public function sliders(){
        $main_slider = Sliders::paginate(3);
        return view('dashboard.main_slider.index',compact(['main_slider']));
    }
    public function edit_slider($id){
        $main_slider = Sliders::where('id',$id)->first();
        return view('dashboard.main_slider.edit',compact(['main_slider']));
    }
   public function update_slider(Request $request,$id){
        $desc = 'desc_'.$this->getCurrentLang();
        $image = 'image_'.$this->getCurrentLang();
        $main_slider = Sliders::where('id',$id)->first();
        $main_slider->$desc = $request->description;
        // $main_slider->desc_ar = $request->description;
        $main_slider->save();
        if ($request->hasFile('image')) {
                $main_slider->$image = $this->upploadImage($request->File('image'), 'assets/images/sliders/');
                // $main_slider->image_ar = $this->uploadImage($request->File('image'), 'assets/images/sliders/');
                $main_slider->save();
            } // end of upload photo
        
        return view('dashboard.main_slider.edit',compact(['main_slider']));
    }
    public function index_cities(){
         $cities = Cities::orderBy('id', 'DESC')->paginate(15);

        return view('dashboard.cities.index', compact(['cities']));
    }
    public function create_city(){
         return view('dashboard.cities.create');
    }
    public function edit_city($id)
    {
        $city = Cities::find($id);
        if (!$city)
            return redirect()->route('admin.cities')->with(['error' => 'هذه القسم غير موجوده']);

        return view('dashboard.cities.edit', compact(['city']));
    } // end of edit
    public function update_city(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $city = Cities::find($id);
            if (!$city)
                return redirect()->route('admin.cities')->with(['error' => 'هذه القسم غير موجوده']);

            //validation
            $rules = [];
            foreach (array_keys(config('laravellocalization.supportedLocales')) as $locale) {
                $rules += [$locale . '.name' => ['required', Rule::unique('cities_translations', 'name')->ignore($city->id, 'cities_id')]];
            }

            $data = $this->validate($request, $rules);


            $city->update($data);

            


            DB::commit();
            return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of update
    
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

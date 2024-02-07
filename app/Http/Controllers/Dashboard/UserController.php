<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserDashboardRequest;
use App\Models\{User, SentNotification, Reserve, SalonReserve, Salons, SalonTranslation,Admin};
use Illuminate\Http\Request;
use App\Traits\HelpersTrait;
use Illuminate\Support\Facades\DB as DB;

class UserController extends Controller
{
    use HelpersTrait;


    public function index(Request $request)
    {
        // $users = User::when($request->user_search_input, function ($q) use ($request) {
        //     return $q->where('first_name', 'LIKE', '%' . $request->user_search_input . '%');
        // })->where('is_owner', 1)->orderBy('id', 'DESC')->paginate(10);
        // })->with('category')->orderBy('id', 'DESC')->paginate(10);
        $users = Admin::paginate(10);

        return view('dashboard.users.index_admin', compact(['users']));
    } // end of index

public function edit_admin($id)
    {
        $user = Admin::find($id);
        if (!$user)
            return redirect()->route('admin.users.index')->with(['error' => 'هذه العميل غير موجوده']);

        return view('dashboard.users.edit_admin', compact(['user']));
    } // end of edit
    
    public function update_admin(Request $request,$id)
    {
        $user = Admin::find($id);
        $request->validate([
            'first_name'  => 'required|string|min:3|max:20',
            'last_name'   => 'required|string|min:3|max:20',
            'username'    => ['required','string','min:3','max:20'],
            'email'       => ['nullable'],
            'image'       => 'nullable',
            'permissions' => 'required|min:1',
        ],
        [
            'first_name.required' => __('user.req_first_name'),
            'last_name.required'  => __('user.req_last_name'),
            'username.required'   => __('user.req_username'),
            'username.unique'     => __('user.unique_username'),
            'email.unique'        => __('user.unique_email'),
        ]);
        $data = $request->except(['permissions', 'image']);

        if ($request->image) {
            if ($user->image != 'default.png') {
                Storage::disk('uploads')->delete('/users_images/' . $user->image);
            }

            $data['image'] = $this->upploadImage($request->image, 'uploads/users_images');
        }

        $user->update($data);
        $user->syncPermissions($request->permissions);
        session()->flash('success', __('user.updated_successfully'));
        return redirect()->route('admin.users.index');
    }
    public function create()
    {
        return view('dashboard.admins.create');
    }
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'first_name'  => 'required|string|min:3|max:20',
            'last_name'   => 'required|string|min:3|max:20',
            'username'    => 'required|string|min:3|max:20|unique:admins',
            'email'       => 'nullable|email|unique:admins',
            'image'       => 'nullable',
            'password'    => 'required|confirmed',
            // 'permissions' => 'required|min:1',
        ],[
            'first_name.required' => __('user.req_first_name'),
            'last_name.required'  => __('user.req_last_name'),
            'username.required'   => __('user.req_username'),
            'username.unique'     => __('user.unique_username'),
            'email.unique'        => __('user.unique_email'),
            'password.required'   => __('user.req_password'),
            'password.confirmed'  => __('user.password_confirmed'),
        ]
        );
            $data = $request->except(['password', 'password_confirmation']);
            $data['password'] = bcrypt($request->password);

            if ($request->image) {
                $data['image'] = uploadImage($request->image, 'uploads/users_images');
             }else{
                $data['image'] = 'default.png';
             }
            $user = Admin::create($data);

            $user->attachRole('admin');

            // $user->syncPermissions($request->permissions);

            session()->flash('success', __('user.added_successfully'));

            return redirect()->route('admin.admins.index');
    }
    public function indexCustomers(Request $request)
    {
        $users = User::when($request->user_search_input, function ($q) use ($request) {
            return $q->where('first_name', 'LIKE', '%' . $request->user_search_input . '%');
            // return $q->with('category')->whereTranslationLike('name', '%' . $request->driver_search_input . '%');
        })->orderBy('id', 'DESC')->paginate(10);
        // })->with('category')->orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.users.index', compact(['users']));
    } // end of index
    public function indexAssistants(Request $request)
    {
        $users = User::when($request->user_search_input, function ($q) use ($request) {
            return $q->where('first_name', 'LIKE', '%' . $request->user_search_input . '%');
            // return $q->with('category')->whereTranslationLike('name', '%' . $request->driver_search_input . '%');
        })->where('is_owner', 0)->orderBy('id', 'DESC')->paginate(10);
        // })->with('category')->orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.users.index', compact(['users']));
    } // end of index
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user)
            return redirect()->route('admin.users.index')->with(['error' => 'هذه العميل غير موجوده']);

        return view('dashboard.users.edit', compact(['user']));
    } // end of edit


    public function update(UpdateUserDashboardRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $user = User::find($id);
            if (!$user)
                return redirect()->route('admin.users.index')->with(['error' => 'هذه العميل غير موجوده']);


            $data = $request->only(['first_name', 'last_name', 'phone', 'country_code', 'email']);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->country_code = $request->country_code;
            $user->email = $request->email;

            // $user->update($data);


            if ($request->hasFile('photo')) {
                // $user->photo = $this->uploadImage($request->File('photo'), 'assets/images/users/');
                $photo = $request->photo->getClientOriginalName();
                $request->photo->move(public_path("assets/images/users"), $photo);
                $user->photo = $photo;
            } // end of upload photo
            $user->save();

            DB::commit();
            return redirect()->back()->with(['success' => __('admin/forms.updated_successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of update


    public function changeStatus($id)
    {
        $user            = user::findOrFail($id);
        $user['active']  = !$user['active'];
        $user->save();
        return redirect()->back();
    } // end of changeStatus


    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user)
                return redirect()->route('admin.users.index')->with(['error' => 'هذا العميل غير موجوده']);


            $user->delete();
            SalonReserve::where('user_id', $id)->delete();
            SentNotification::where('user_id', $id)->delete();

            return redirect()->back()->with(['success' => __('admin/forms.deleted_successfully')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('admin/forms.wrong')]);
        }
    } // end of destroy
}

<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if(Auth::user()->user_type == 1) {

            $users = User::where('id', '!=', Auth::user()->id)->where('user_type', 2)->orderBy('first_name','DESC');

            if ($request->has('first_name') && $request->first_name != '') {
                $first_name = $request->first_name;
                $users = $users->where('first_name', 'LIKE', $first_name.'%');
            }

            if ($request->has('last_name') && $request->last_name != '') {
                $last_name = $request->last_name;
                $users = $users->where('last_name', 'LIKE', $last_name.'%');
            }

            if ($request->has('email') && $request->email != '') {
                $email = $request->email;
                $users = $users->where('email', 'LIKE', $email.'%');
            }

            if ($request->has('status') && $request->status != '') {
                $status = $request->status;
                $users = $users->where('status', $status);
            }

            $data = $users->paginate(10);
            $filters = $request->all();

            return view('users.index',compact('data', 'filters'))
                ->with('i', ($request->input('page', 1) - 1) * 10);
        } else {
            return redirect()->route('home');
        }
    }

    public function create(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'title' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'min:12|max:18|unique:users',
            'status' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();

        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/users');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = 'png';
            // $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                // $name = preg_replace('/\s+/', '', $request->first_name);
                // $frontNewName = $name.'-'.$user->id.$extension;

                $uniqueIdentifier = uniqid();

                $data['picture'] = $image = $uniqueIdentifier.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirmation']);
        User::create($data);

        return redirect()->route('users.index')->with('success','User created successfully');
    }

    public function show(User $user)
    {
        if (!empty($user)) {
            $data = [
                'user' => $user,
            ];
            return view('users.show', compact('countries', 'user'));

        } else {
            return redirect()->route('home');
        }

    }

    public function edit(User $user)
    {
        $user = User::find($user->id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'picture' => 'file|mimes:jpeg,jpg,gif,png|max:2048',
            'mobile_number' => 'min:12|max:18|unique:users,mobile_number,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->all();
        // Picture
        if (isset($data['picture'])) {
            $imageStorage = public_path('images/users');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            $picture = $request->picture;
            $extension = 'png';
            // $extension = $picture->getClientOriginalExtension();

            if(in_array($extension, $imageExt)) {
                // $name = preg_replace('/\s+/', '', $request->first_name);
                // $frontNewName = $name.'-'.$user->id.$extension;

                $uniqueIdentifier = uniqid();

                $data['picture'] = $image = $uniqueIdentifier.'.'.$extension;
                $picture->move($imageStorage, $image); // Move File
            }
        }

        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
            $data = Arr::except($data,array('password_confirmation'));
        }else{
            $data = Arr::except($data,array('password'));
            $data = Arr::except($data,array('password_confirmation'));
        }

        $user = User::find($user->id);
        $user->update($data);

        if(isset($userID)) {
            return redirect()->route('users.show', ['user' => $userID])->with('success','User updated successfully');
        } else {
            return redirect()->route('users.index')->with('success','User updated successfully');
        }
    }

    public function destroy(User $user)
    {
        // dd('aa');
        // $user->delete();
        // return redirect()->route('customers.index')->with('success','User deleted successfully');
    }
}

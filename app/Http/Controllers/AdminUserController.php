<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
{
    // all method of ---create new user---
    public function create()
    {
        $user_list = User::where([['role', 'admin'], ['id', '!=', auth()->id()]])->orWhere('role', 'writter')->latest()->paginate(5)->withQueryString();
        return view('users.create', compact('user_list'));
    }
    // data insert from --create new user--
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'email' => 'email',
            'password' => Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
        ]);
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
            'created_at' => now(),
        ]);
        if ($request->role == 'admin') {
            return back()->withSuccess('admin created successfully');
        } else {
            return back()->withSuccess('writter created successfully');
        }
    }
    // delete admin or writter data 
    public function destroy($id)
    {
        User::find($id)->delete();
        return back();
    }

    //return edit view page 
    public function edit()
    {
        return view('profile.edit');
    }
    // Update admin or writter data who are already log in to dashboard
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone_number' => 'min:11',
            'profile_image' => 'mimes:png,jpg',
            'cover_image' => 'mimes:png,jpg',
        ]);
        User::find($id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);
        
        if ($request->hasFile('profile_image')) {
            $file_name = auth()->id() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $img = Image::make($request->file('profile_image'));
            $img->save(base_path('public/upload/admin_profile_image/' . $file_name), 80);
            User::find($id)->update([
                'profile_image' => $file_name,
            ]);
        }
        if ($request->hasFile('cover_image')) {
            $file_name = auth()->id() . '.' . $request->file('cover_image')->getClientOriginalExtension();
            $img = Image::make($request->file('cover_image'));
            $img->save(base_path('public/upload/admin_cover_image/' . $file_name), 80);
            User::find($id)->update([
                'cover_image' => $file_name,
            ]);
        }
        return back()->withSuccess('Profile updated successfully');
    }

    // Update admin or writter password who are already log in to dashboard
    public function update_password(Request $request, $id)
    {
        $request->validate([
            '*' => 'required',
            'new_password' => ['different:old_password','same:confirm_password',Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);
        if (Hash::check($request->old_password,auth()->user()->password)) {
            User::find($id)->update([
                'password'=>Hash::make($request->new_password)
            ]);
        }else {
            return back()->with('error', 'Your current password does not match!');
        }
        return back()->withSuccess('Password successfully updated');
        
    }
}

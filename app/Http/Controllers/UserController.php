<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profil(Request $request)
    {


        return view('profil', ['title' => 'halaman profil', 'judul' => 'User']);
    }


    public function index()
    {
        $user = User::where('role_id', 2)->where('status', 'active')->get();

        return view('user', ['users' => $user]);
    }

    public function registeredUser()
    {

        $registeredUser = User::where('status', 'in active')->where('role_id', 2)->get();

        return view('registerd-user', ['registeredUser' => $registeredUser]);
    }

    public function UserShow($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-detail', ['user' => $user]);
    }

    public function approve($slug)
    {
        $user = user::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('user-detail/' . $slug)->with('status', 'User Update Approve success ');
    }

    public function delete($slug)
    {
        $user = user::where('slug', $slug)->first();
        return view('user-deleted', ['user' => $user]);
    }

    public function destroy($slug)
    {
        $user = user::where('slug', $slug)->first();
        $user->delete();
        return redirect('user')->with('status', 'User block was successful');
    }

    public function blockUser()
    {
        $userDelete = User::onlyTrashed()->get();
        return view('list-user-delete', ['delete' =>   $userDelete]);
    }

    public function UserRestore($slug)
    {
        $category = User::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('user')->with('status', 'restore user successfully  ');
    }
}
<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PicUploadRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user', ['page_name' => 'My Profile']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profilePicUpload(PicUploadRequest $request, Gallery $gallery)
    {
        $path_to_delete = Gallery::myProfilePic();

        foreach ($path_to_delete as $item) {
            Storage::delete($item->path);
        }

        $path = $request->file('profile-pic')->store('details');

        Gallery::query()->where('user_id', auth()->id())->where('purpose', 'selfie_photo')->delete();
        $gallery->newQuery()->insert([
            'user_id'    => auth()->user()->id,
            'path'       => $path,
            'purpose'    => 'selfie_photo',
            'created_at' => Carbon::now(),
        ]);

        return redirect('/')->with('success', 'New Photo has been updated!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->input();
        unset($data['_token']);
        User::query()->where('id', auth()->user()->id)->update($data);

        return redirect('/')->with('success', 'Profile has been updated!');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        User::query()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PicUploadRequest;
use App\Http\Requests\GovIdStoreRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.profile');
    }

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

        session()->put('success', 'New Photo has been updated!');

        return redirect('/p');
    }

    public function govIdUpload(GovIdStoreRequest $request, Gallery $gallery)
    {
        $path_to_delete = Gallery::myGovIdPic();

        foreach ($path_to_delete as $item) {
            Storage::delete($item->path);
        }

        $path = $request->file('gov-id')->store('details');

        Gallery::query()->where('user_id', auth()->id())->where('purpose', 'gov_id')->delete();
        $gallery->newQuery()->insert([
            'user_id'    => auth()->user()->id,
            'path'       => $path,
            'purpose'    => 'gov_id',
            'created_at' => Carbon::now(),
        ]);

        session()->put('success', 'Gov Id for verification has been sent!');

        return redirect('/p');
    }

    public function store(Request $request)
    {
        $data = $request->input();
        unset($data['_token']);
        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        User::query()->where('id', auth()->user()->id)->update($data);

        session()->put('success', 'Details has been updated!');

        return redirect('/p');
    }

    public function changePasswordForm()
    {
        return view('auth.change_pass');
    }

    public function CPSubmit(ChangePasswordRequest $request)
    {
        User::query()->where('id', auth()->id())->update([
            'password' => Hash::make($request->password),
        ]);

        session()->put('success', 'Password has been updated!');

        return redirect()->route('p.index');
    }

    public function getDetailById(Request $request)
    {
        return User::find($request->id);
    }

    public function resetPass($id)
    {
        User::query()->where('id', $id)->update([
            'password' => Hash::make('password'),
        ]);

        session()->put('success', 'Password has been reset!');

        return redirect()->route('accounts');
    }
}

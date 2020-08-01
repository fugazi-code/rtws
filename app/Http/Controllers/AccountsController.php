<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;

class AccountsController extends Controller
{
    public function index()
    {
        return view('accounts', ['page_name' => 'User Accounts']);
    }

    public function fetch()
    {
        return DataTables::of(User::all())->make(true);
    }

    public function signup()
    {
        return view('account-signup', ['page_name' => 'Sign Up']);
    }

    public function store(AccountStoreRequest $request, User $user, Gallery $gallery)
    {
        $path_selfie_photo  = $request->file("selfie_photo")->store('details');
        $path_license_plate = $request->file("license_plate")->store('details');
        $path_front         = $request->file("front")->store('details');
        $path_side          = $request->file("side")->store('details');
        $path_back          = $request->file("back")->store('details');
        $path_or_cr         = $request->file("or_cr")->store('details');

        $data = $request->input();
        unset($data['_token']);
        $data['password'] = Hash::make('password');
        $id               = $user->newQuery()->insertGetId($data);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_selfie_photo,
            'purpose' => 'selfie_photo',
        ]);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_license_plate,
            'purpose' => 'license_plate',
        ]);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_front,
            'purpose' => 'front',
        ]);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_side,
            'purpose' => 'side',
        ]);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_back,
            'purpose' => 'back',
        ]);

        $gallery->newQuery()->insert([
            'user_id' => $id,
            'path'    => $path_or_cr,
            'purpose' => 'or_cr',
        ]);

        return redirect('accounts')->with('success', 'New User has been added!');
    }

    public function edit($id)
    {
        $gallery = Gallery::query()->where('user_id', $id)->get();
        $user    = User::query()->where('id', $id)->get()[0];

        return view('account-edit', ['page_name' => 'Edit User', 'gallery' => $gallery, 'user' => $user]);
    }

    public function update(AccountUpdateRequest $request, $id)
    {

        foreach ($request->file() as $key => $file) {
            Storage::delete(Gallery::query()->where('user_id', $id)->where('purpose', $key)->get('path')[0]->path);
            $path = $file->store('details');
            Gallery::query()->where('user_id', $id)->where('purpose', $key)->update([
                'user_id' => $id,
                'path'    => $path,
                'purpose' => $key,
            ]);
        }

        $data               = $request->input();
        unset($data['_token']);
        User::query()->where('id', $id)->update($data);

        return redirect('accounts')->with('success', 'New User has been updated!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::query()->where('user_id', $id)->get();
        foreach ($gallery as $item) {
            Storage::delete($item->path);
        }

        Gallery::query()->where('user_id', $id)->delete();
        User::query()->where('id', $id)->delete();

        return redirect('accounts')->with('success', 'New User has been deleted!');
    }
}

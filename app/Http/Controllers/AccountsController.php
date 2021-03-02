<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewRegistration;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;

class AccountsController extends Controller
{
    public function index()
    {
        return view('auth.accounts');
    }

    public function fetch()
    {
        return DataTables::of(User::query()->whereNotIn('role', ['superadmin']))->make(true);
    }

    public function signUp()
    {
        return view('auth.accounts_add');
    }

    public function store(AccountStoreRequest $request, User $user, Gallery $gallery)
    {
        $data = $request->input();
        unset($data['_token']);
        $data['password']   = Hash::make('password');
        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        $id                 = $user->newQuery()->insertGetId($data);

        User::find($id)->notify(new NewRegistration());

        foreach ($request->file() as $key => $file) {
            $path = $file->store('details');
            $gallery->newQuery()->insert([
                'user_id' => $id,
                'path'    => $path,
                'purpose' => $key,
            ]);
        }

        session()->put('success', 'New User has been added!');

        return redirect('accounts');
    }

    public function edit($id)
    {
        $gallery = Gallery::query()->where('user_id', $id)->get();
        $user    = User::query()->where('id', $id)->get()[0];

        return view('auth.accounts_edit', ['gallery' => $gallery, 'user' => $user]);
    }

    public function update(AccountUpdateRequest $request, $id)
    {

        foreach ($request->file() as $key => $file) {
            $gallery = Gallery::query()->where('user_id', $id)->where('purpose', $key)->get('path');

            if ($gallery->count()) {
                Storage::delete($gallery[0]->path);
            }
            $path = $file->store('details');
            Gallery::query()->where('user_id', $id)->where('purpose', $key)->delete();
            Gallery::query()->insert([
                'user_id' => $id,
                'path'    => $path,
                'purpose' => $key,
            ]);
        }

        $data = $request->input();
        unset($data['_token']);
        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        User::query()->where('id', $id)->update($data);

        session()->put('success', 'User has been updated!');

        return redirect('accounts');
    }

    public function destroy($id)
    {
        $gallery = Gallery::query()->where('user_id', $id)->get();
        foreach ($gallery as $item) {
            Storage::delete($item->path);
        }

        Gallery::query()->where('user_id', $id)->delete();
        User::query()->where('id', $id)->delete();

        session()->put('success', 'New User has been deleted!');

        return redirect('accounts');
    }

    public function notify()
    {
        User::find(1)->notify(new NewRegistration());
    }
}

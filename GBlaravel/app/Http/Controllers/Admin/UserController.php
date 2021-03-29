<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::query()->where('id', '!=', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->isMethod('put')) {
            $this->validate($request, $this->validateRules($user->id), [], $this->attributeNames());

            if (Hash::check($request->post('newPassword'), $user->password)) {
                $user->fill([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('newPassword')),
                    'email' => $request->post('email')
                ])->save();
            } else {
                $user->fill([
                    'name' => $request->post('name'),
                    'email' => $request->post('email')
                ])->save();
            }
            return redirect()->route('admin.users.index')->with('success', 'Профиль успешно изменен!');
        }

        return view('admin.users.index', [
            'users' => User::all()
        ]);   
    }

    public function status(Request $request, User $user)
    {
        if ($request->id != Auth::id()) {
            $user->where('id', $request->id)->update(['is_admin' => $request->is_admin]);
            return response()->json([
                    'id' => $request->id,
                    'is_admin' => $request->is_admin
                ]);
        }
        return redirect()->route('admin.users.index')->with('error', 'Нельзя снять админа с себя');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "Пользователь удален!");
    }

    protected function validateRules($id)
    {
        return [
            'name' => 'required|string|max:35',
            'email' => 'required|email|unique:users,email,' . $id,
            'newPassword' => 'nullable|string|min:3'
        ];
    }

    protected function attributeNames()
    {
        return [
            'newPassword' => 'Новый пароль'
        ];
    }
}

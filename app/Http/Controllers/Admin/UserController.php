<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Вывод списка всех пользователей
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    // Изменение роли пользователя
    public function updateRole(Request $request, User $user)
    {
        // Защита от случайного снятия прав с самого себя
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Вы не можете изменить роль самому себе.');
        }

        $request->validate([
            'role' => ['required', 'in:user,manager,admin'],
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', "Роль пользователя {$user->name} обновлена.");
    }
}

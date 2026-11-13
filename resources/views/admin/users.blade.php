@extends('layouts.main')

@section('title', 'Админ-панель')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
@endpush

@section('content')
    <div class="admin-container">
        <h1>Управление пользователями и ролями</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="table-wrapper" style="overflow-x: auto;">
{{--            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">--}}
            <table border="1" cellpadding="10" cellspacing="0" class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="role-form">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role">
                                        <option value="user" @selected($user->role === 'user')>Пользователь</option>
                                        <option value="manager" @selected($user->role === 'manager')>Менеджер</option>
                                        <option value="admin" @selected($user->role === 'admin')>Администратор</option>
                                    </select>

                                    <button type="submit">ОК</button>
                                </form>
                            @else
                                <span>Текущий аккаунт</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

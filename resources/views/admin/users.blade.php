@extends('layouts.main')

@section('title', 'Админ-панель')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endpush

@section('content')
    <h1 class="admin_title">УПРАВЛЕНИЕ РОЛЯМИ</h1>
    <div class="admin-container">

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="table-wrapper">
            <table class="custom-table">
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
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="status-form">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role" class="status-select">
                                        <option value="user" @selected($user->role === 'user')>Пользователь</option>
                                        <option value="manager" @selected($user->role === 'manager')>Менеджер</option>
                                        <option value="admin" @selected($user->role === 'admin')>Администратор</option>
                                    </select>

                                    <button class="status-btn" type="submit">ОК</button>
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

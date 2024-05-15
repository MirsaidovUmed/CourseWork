@extends('layouts.app')

@section('content')
    <div>
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
            <label for="second_name">Second Name:</label>
            <input type="text" name="second_name" id="second_name" value="{{ $user->second_name }}">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <button type="submit">Update</button>
        </form>
    </div>
@endsection

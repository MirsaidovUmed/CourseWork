@extends('layouts.app')

@section('content')
    <div>
        <h2>Create User</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name">
            <label for="second_name">Second Name:</label>
            <input type="text" name="second_name" id="second_name">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <button type="submit">Create</button>
        </form>
    </div>
@endsection

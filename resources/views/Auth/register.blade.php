@extends('layouts.app')

@section('title', 'Register')
    
@section('content')
    <form method="POST" action="">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="mobile_number">Phone number:</label>
        <input type="text" name="mobile_number" id="phone"><br>
        <input type="submit" value="Submit">
    </form>
@endsection
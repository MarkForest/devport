@extends('layouts.master')
@section('content')
    <div class="page__content">
        <h2 class="page__header">Register</h2>
        <div class="page__form">
            @include('auth._errors')
            <form action="/register" method="post" class="form">
                {{csrf_field()}}
                <div class="form__group">
                    <label for="user_name" class="form__label">Name</label>
                    <input type="text" class="form__control" name="name" value="{{old('user_name')}}">
                </div>
                <div class="form__group">
                    <label for="phone_number" class="form__label">Phone Number</label>
                    <input type="text" class="form__control" name="phone_number" value="{{old('phone_number')}}">
                </div>
                <button class="form__submit bg_primary" type="submit">Register</button>
            </form>
        </div>
    </div>
@endsection

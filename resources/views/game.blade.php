@extends('layouts.master')
@section('content')
    <input type="hidden" value="{{$link->id}}" name="link_id">
    <div class="panel-buttons">
        <button class="panel-button lucky">Im feeling lucky</button>
    </div>
    <div class="game">
        <div class="ball"></div>
        <div class="goal"></div>
    </div>
    <div class="panel-buttons right">
        <button class="panel-button history">History</button>
        <form action="/link/new" method="post">
            {{csrf_field()}}
            <button type="submit" class="panel-button new">New Link</button>
        </form>
        <form action="/link/deactivate" method="post">
            {{csrf_field()}}
            <input type="hidden" value="{{$link->id}}" name="link_id">
            <button type="submit" class="panel-button deactivate">Deactivate</button>
        </form>

    </div>
@endsection
@section('script')
    <script src="/public/js/game.js"></script>
@endsection

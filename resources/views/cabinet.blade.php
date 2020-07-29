@extends('layouts.master')
@section('content')
    <div class="page__content">
        <div class="page__header">
            <h2 class="page__header_text">
                {{$user->name}}
            </h2>
            <a href="/logout" class="link link_contrast">Log Out</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Link</th>
                    <th>Is Active</th>
                    <th>Created At</th>
                    <th>Life Days</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>

                @foreach($links as $link)
                    <tr>
                        <td><input class="input_link" type="text" readonly value="{{$domain.'/link/'.$link->link}}" id="input_{{$link->link}}"></td>
                        <td>{{$link->is_active ? 'Yes' : 'No'}}</td>
                        <td>{{$link->created_at}}</td>
                        <td>
                            @php
                                $current = time();
                                $life_date = strtotime('+ 7 day', strtotime($link->created_at));
                                $diff = intval(date('days', ($life_date - $current)));
                            @endphp
                            {{$diff != 8 ? $diff : 7}}
                        </td>

                        <td>
                            @if($link->is_active)
                                <a href="/link/{{$link->link}}" class="link-open link" target="_blank">Open</a>
                                <a onclick="copyFunction('input_{{$link->link}}')" class="link-copy link">Copy</a>
                            @else
                                Deactivated
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="/js/functions.js"></script>
@endsection

@extends('layout.app')

@section('title', '错误页面')

@section('content')
    <div id="error-page">
        <img src="/dist/img/404.gif" alt="">
        <h4>{{ $error_message  }}</h4>
    </div>
    <style>
        body {
            background-color: #f0f0f0 !important;
        }
    </style>
@endsection

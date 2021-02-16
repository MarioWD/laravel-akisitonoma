@extends('layouts.frontend')
@section('content')
    <welcome-page-catering :menus='{{ json_encode($menus) }}'></welcome-page-catering>
    @if (!$menus->isEmpty())
    <welcome-page-menu :menu='{{ json_encode($menus[0]) }}'></welcome-page-menu>
    @endif
@endsection

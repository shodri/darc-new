@extends('layouts.darc')
@section('content')
{!! str_replace('%_site_url_%', url('/'), $page->content) !!}
@endsection
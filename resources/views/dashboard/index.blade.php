{{-- extends = perpanjang ia seperti include --}}

@extends('layouts.main')

@section('title','Dashboard')
@section('content')
 
@if (Auth::check() && Auth::user()->level_id == 1)
<!DOCTYPE html>

@endif


@endsection
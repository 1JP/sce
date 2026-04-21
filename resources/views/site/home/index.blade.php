@extends('layouts.app')

@section('content')
<site-home :user="{{ $user }}"></site-home>
@endsection
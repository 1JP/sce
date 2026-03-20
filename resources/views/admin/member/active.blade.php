@extends('layouts.admin-auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-member-active
                email="{{ $record->email }}"
                hash-token="{{ $token }}"
            />
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container">
      <div class="row text-left">
        <div class="p-5 col-lg-6 col-10 mx-auto bg-light border-0 shadow-sm">
            <h3 class="mb-4 pb-4">Login</h3>
            <form class="" method="POST" action="{{ route('signin') }}">
                @csrf
                <div class="form-group"> 
                    <label>E-mail<br></label>
                    <component-input
                        :required="true"
                        :input-type="'email'"
                        :placeholder="'E-mail'"
                        :name-id="'email'"
                    /> 
                </div>
                <div class="form-group"> 
                    <label>Senha</label>
                    <component-input
                        :required="true"
                        :input-type="'password'"
                        :placeholder="'Senha'"
                        :name-id="'password'"
                    />
                    <small class="form-text text-muted text-right">
                        <a href="#"> Primeiro acesso</a>-
                        <a href="#"> Esqueci minha senha </a>
                    </small> 
                </div>
                <button type='submit' class="btn btn-primary btn-block rounded w-100" >Login</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
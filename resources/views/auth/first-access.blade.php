@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <div class="container">
      <div class="row text-left">
        <div class="p-5 col-lg-6 col-10 mx-auto bg-light border-0 shadow-sm">
            <h3 class="mb-4 pb-4">Primeiro Acesso</h3>
            <form class="" method="POST" action="#">
                <div class="form-group"> 
                    <label>E-mail<br></label>
                    <input name='email' type="email" class="form-control" placeholder="E-mail" id="form14"> 
                </div>
                <button type='submit' class="btn btn-primary btn-block rounded w-100" >Enviar link de primeiro acesso</button>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
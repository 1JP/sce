@if ($errors->any())
    <div class = "alert alert-danger">
        <ul>
            <h5>
                <i class="bi bi-x-circle me-1"></i>OCORREU UM ERRO
            </h5>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
@endif
@if (session('success'))
    <div class = "alert alert-success" style="text-align: center;">

        {!! session('success') !!}

    </div>
@endif
@if (session('info'))
    <div class = "alert alert-info" style="text-align: center;">

        {!! session('info') !!}

    </div>
@endif
@if (session('warning'))
    <div class = "alert alert-warning" style="text-align: center;">

        {!! session('warning') !!}

    </div>
@endif
@if (session('danger'))
    <div class = "alert alert-danger" style="text-align: center;" id="danger">

        {!! session('danger') !!}

    </div>
@endif
<div class = "alert alert-danger" style="text-align: center; display: none;" id="danger"></div>
<div class = "alert alert-success" style="text-align: center;display: none;" id="success"></div>

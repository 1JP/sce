@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <site-index-user/>
    </div>
</div>

<model :title="'Deseja ser um cliente?'" :name="'exampleModal'">
    Deseja ser um cliente para o público comentar sobre o seu livro, filme, série, anime até mesmo seu mangá?
    So clicar <b>Sim</b>
    <template v-slot:footer>
        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</a>
        <a href="{{ route('pagamento.create') }}" class="btn btn-primary">Sim</a>
    </template>
</model>
@endsection
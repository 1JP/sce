@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3" style="">
                <list-group :class-item="'list-group-flush mb-5'">
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a href="{{ route('usuarios.index') }}">
                            Minha conta
                        </a>
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Seja ser um cliente?
                        </a>
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a href="#">
                            Área administrativa
                        </a>
                    </list-group-item>
                    <list-group-item :class-item="'active'">
                        <a href="{{ route('pagamento.show', 1) }}">
                            Assinatura
                        </a>
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a href="#">
                            Sair
                        </a>
                    </list-group-item>
                </list-group>
            </div>
            <div class="col-lg-9">
                <component-card
                    :class-card="'mb-2'"
                    :card-body="true"
                    style="background: #EDEBE4;"
                >
                    <template v-slot:body>
                        <div class="row d-flex justify-content-center align-items-center mx-auto">
                            <div class="col-lg-12 col-12 px-0">
                              <div class="row">
                                <div class="col-md-12 d-inline-flex justify-content-between">
                                  <h4 class="text-dark p-2">Faturas<br></h4>
                                    <a class="btn btn-link btn-sm" href="#">
                                        Ver tudo
                                    </a>
                                </div>
                              </div>
                              <list-group>
                                <list-group-item :class-item="'border-0 d-flex justify-content-between ps-0 border-radius-lg'" style="background: #EDEBE4;">
                                    <div class="d-flex flex-column">
                                        03 de janeiro de 2025
                                        <span class="text-xs">#FA-1</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        <p>
                                            R$ 200,00
                                            <a href="#" class="me-1">
                                                <i class="bi bi-file-earmark-pdf fs-3"></i>
                                            </a>
                                        <p>
                                    </div>
                                </list-group-item>
                                <list-group-item :class-item="'border-0 d-flex justify-content-between ps-0 border-radius-lg'" style="background: #EDEBE4;">
                                    <div class="d-flex flex-column">
                                        03 de janeiro de 2025
                                        <span class="text-xs">#FA-1</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        <p>
                                            R$ 200,00
                                            <a href="#" class="me-1">
                                                <i class="bi bi-file-earmark-pdf fs-3"></i>
                                            </a>
                                        <p>
                                    </div>
                                </list-group-item>
                              </list-group>
                            </div>
                        </div>
                    </template>
                </component-card>
            </div>
        </div>
    </div>
</div>
@endsection
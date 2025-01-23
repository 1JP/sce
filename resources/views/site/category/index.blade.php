@extends('layouts.app')

@section('css')
    <style>       
        /* Para o estado desativado (colapsado) */
        .accordion-item {
            background-color: #EDEBE4; /* Cor de fundo para quando o item estiver desativado */
        }

        /* Opção: Customizar o botão de "accordion-button" */
        .accordion-button:not(.collapsed) {
            background-color: black; /* Cor de fundo quando o botão estiver expandido */
        }

        .accordion-button:not(.collapsed) h3{
            color: white; /* Cor do texto no estado ativo */
        }

        .accordion-button.collapsed {
            background-color: #EDEBE4; /* Cor de fundo quando o botão estiver colapsado */
            color: #EDEBE4; /* Cor do texto do botão colapsado */
        }

        .form-check-label {
            font-weight: 500;
            color: #74642F;
            margin: 0;
        }

        .btn-block {
            display: block;
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="pt-3">
    <div class="container">
      <div class="row mx-0">
        <div class="col-md-12 px-0">
            <breadcrumb :items='@json([
                [ "name" => "Categorias" ],
            ])' :icone="'bi bi-house-door text-muted'"
            :text-color="''"></breadcrumb>
        </div>
      </div>
    </div>
</div>

<div>
    <div class="container px-0">
      <!-- Título -->
      <div class="row mx-auto py-2 d-lg-none">
        <div class="col-md-12">
          <h3 class="">Categorias <span style="font-weight: normal;" class="text-muted">(133)</span></h3>
        </div>
      </div>
      <!-- Filtros -->
      <div class="row mx-auto align-items-center">
        <!-- Select Dropdown -->
        <div class="col-6 d-lg-none">
          <div class="form-group mb-0">
            <select class="form-control border rounded" style="height: 38px; padding: 0 10px; font-size: 14px;">
              <option value="1">Popular</option>
              <option value="4">Nome (A-Z)</option>
              <option value="5">Nome (Z-A)</option>
            </select>
          </div>
        </div>
        <!-- Botão Filtros -->
        <div class="col-6 d-lg-none">
            <button type="button" class="btn btn-primary rounded d-flex align-items-center justify-content-center w-100" 
            style="height: 40px;margin-bottom: 38px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#filtros">
                <i class="bi bi-sliders" style="margin-right: 5px;"></i> Filtros
            </button>
        </div>
      </div>
    </div>
</div>

<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
                <component-accordion/>
            </div>
            <div class="col-lg-9">
                <div class="row d-none d-lg-block">
                    <div class="col-lg-12 d-flex justify-content-between align-items-start">
                        <h3 class="mb-0 mt-0 me-0">Categorias 
                            <span style="font-weight: normal;" class="text-muted">(133)</span>
                        </h3>
                        <div class="row">
                            <label class="col-form-label col-lg-4">Exibir</label>
                            <div class="col-lg-8">
                                <select class="form-control">
                                    <option value="1">30</option>
                                    <option value="2">60</option>
                                    <option value="3">90</option>
                                    <option value="4">120</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-form-label col-lg-6">Filtrar por:</label>
                            <div class="col-lg-6"><select class="form-control ">
                                <option value="1">Popular</option>
                                <option value="2">A-Z</option>
                                <option value="3">Z-A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <site-post></site-post>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
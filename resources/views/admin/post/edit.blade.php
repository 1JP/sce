@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts", "route" => route("admin.posts.index") ],
        [ "name" => "Editar" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-4">
                    <h6>Editar Posts</h6>
                </div>
                <div class="col-lg-8 d-flex justify-content-end">
                    <a href="{{ route('admin.posts.index') }}" class="btn bg-gradient-primary">
                        Voltar
                    </a>
                </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="card-body border rounded">
                <form class="">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Post"> 
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="form-group">
                                <label>Post ativado?</label>
                                <div class="custom-control custom-toggle">
                                    <input class="custom-control-input" type="checkbox" value="on" data-off-label="OFF" id="customCheckProdutoAtivado">
                                    <label class="custom-control-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Digite aqui a descrição do post"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                        <h5 class="">
                            <i class="fa fa-fw mr-2 fa-picture-o text-secondary"></i>Imagens
                        </h5>
                    </div>
                </div>
                <div class="row p-4 mt-4 mx-auto rounded text-muted" style="	border-style: dashed;	border-color: #f2f2f2;">
                    <div class="col-lg-12">
                        <h5 class="text-center text-muted"><i class="fa fa-fw fa-picture-o pr-4 fa-4x"></i></h5>
                        <h5 class="text-center">Arraste e solte suas Imagens aqui</h5>
                        <p class="text-center">Máximo de 10 imagens. Tamanho máximo 3MB.&nbsp;<br>Para maior qualidade envie imagens no formato JPG ou PNG.</p>
                    </div>
                </div>
                <p class="text-left text-muted small pt-3"><i>Tamanho recomendado: 1024px</i></p>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                                <h5><i class="fa fa-fw fa-list mr-2 text-secondary"></i>Classificação Indicativa</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                              <div class="form-group d-flex">
                                <select class="form-control col-12 col-lg-12" name="categoria" id="categoria">
                                  <option disabled="" selected="" value="">--Selecione uma categoria</option>
                                  <optgroup label="Categoria pai 01">
                                    <option value="">Alfa</option>
                                    <option value="">Beta</option>
                                  </optgroup>
                                  <optgroup label="Categoria pai 02">
                                    <option value="">Lambda</option>
                                    <option value="">Mu</option>
                                    <option value="">Nu</option>
                                  </optgroup>
                                </select>
                                <div id="divcertificado" style="display: none;">
                                  <p id="pcertificado">* CAMPO OBRIGATÓRIO *</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 d-inline-flex justify-content-between align-items-center">
                              <h5><i class="fa fa-fw fa-list mr-2 text-secondary"></i>Categorias</h5>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="form-group d-flex">
                                <select class="form-control col-12 col-lg-12" name="categoria" id="categoria">
                                  <option disabled="" selected="" value="">--Selecione uma categoria</option>
                                  <optgroup label="Categoria pai 01">
                                    <option value="">Alfa</option>
                                    <option value="">Beta</option>
                                  </optgroup>
                                  <optgroup label="Categoria pai 02">
                                    <option value="">Lambda</option>
                                    <option value="">Mu</option>
                                    <option value="">Nu</option>
                                  </optgroup>
                                </select>
                                <div id="divcertificado" style="display: none;">
                                  <p id="pcertificado">* CAMPO OBRIGATÓRIO *</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
<fixed-bottom
    :cancel="'{{ route('admin.posts.index') }}'"
    :name="'Cadastrar'"
></fixed-bottom>
@endsection
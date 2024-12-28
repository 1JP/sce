@extends('layouts.report')

@section('title','Relatório Geral')

@section('content')
<nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top">
    <div class="container">
        <!-- Botão para expandir/colapsar o menu no mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10" aria-controls="navbar10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-fw mr-1 fa-file-word-o"></span>
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10" aria-controls="navbar10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-fw mr-1 fa fa-print"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar10">
            <!-- Título -->
            <b class="text-light mr-auto">Exportar como:</b>
            <!-- Botões -->
            <a id="export" class="btn btn-outline-light my-1 my-md-0 m-2" href="3" target="_blank">
                <i class="fa fa-fw mr-1 fa-file-word-o"></i>Word
            </a>
            <a id="export-pdf" class="btn btn-outline-light my-1 my-md-0" href="3" target="_blank">
                <i class="fa fa-fw mr-1 fa fa-print"></i>Impressão
            </a>
        </div>
    </div>
</nav>    

<div class="container page-avoid">
    <div class="row">
        <div class="col-12">
            <h4 class="text-primary py-3 text-center">Relatório Comentarios</h4>
        </div>
    </div>
    <div class="row border-bottom">
        <div class="col-6 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Classificação Indicativa</small><br>Departamento Pessoal
            </h6>
        </div>
        <div class="col-6 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Categoria</small><br>Controlador
            </h6>
        </div>
        <div class="col-4 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Likes</small><br>8
            </h6>
        </div>
        <div class="col-4 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Deslikes</small><br>9
            </h6>
        </div>
        <div class="col-6 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Comentários Positivos</small><br>60%
            </h6>
        </div>
        <div class="col-6 col-md-2">
            <h6 class="py-2 text-dark">
                <small class="text-muted">Comentários Negativos</small><br>40%
            </h6>
        </div>
    </div>

    <div class="row border-bottom">
        <div class="col-12">
            <p class="pt-3" id="finalidade"><strong>Descrição:</strong></p>
            <p>Coleta de dados para o processo de recrutamento e seleção interno das vagas da empresa.</p>
        </div>
    </div>
</div>

<div class="container page-avoid">
    <div class="row page-avoid">
        <div class="col-md-12 py-4">
            <h4 class="text-primary py-4 text-center">Comentários Mais Comentados (2)</h4>
            <div class="row border-bottom align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
            <div class="row border-bottom align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container page-avoid">
    <div class="row page-avoid">
        <div class="col-md-12 py-4">
            <h4 class="text-primary py-4 text-center">Comentários Positivos (2)</h4>
            <div class="row border-bottom align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
            <div class="row border-bottom align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container page-avoid">
    <div class="row page-avoid">
        <div class="col-md-12 py-4">
            <h4 class="text-primary py-4 text-center">Comentários Negativos (2)</h4>
            <div class="row border-bottom align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="py-4 col-sm-12 col-md-9">
                    <h6>A.7.2.1 Identificação e documentação do propósito</h6>
                    <p>A organização deve identificar e documentar os propósitos específicos pelos quais os DP serão tratados.</p>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Like</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Deslike</h6>
                    <h3 class="text-primary">52</h3>
                </div>
                <div class="py-2 col-sm-4 col-md-1 text-center">
                    <h6>Comentários</h6>
                    <h3 class="text-primary">52</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row d-flex flex-row justify-content-center align-items-center border-bottom border-top py-2 pt-4">
        <div style="" class="col-2 col-lg-2">
            <img class="d-block p-2" src="#" height="40px">
        </div>
        <div style="" class="col-lg-10 text-right col-10">
            <p>Relatório emitido em 10/12/2024 às 00:47 em www.sce.com.br - copyright © 2024 </p>
        </div>
    </div>
</div>
@endsection
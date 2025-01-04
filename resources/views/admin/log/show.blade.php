@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Logs" , "route" => route("admin.logs.index") ],
        [ "name" => "Visualizar log"]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <component-card
                :class-card="'mb-4'"
                :card-header="true"
                :class-header="'pb-0'"
                :card-body="true"
                :class-body="'px-0 pt-0 pb-2'"
            >
                <template v-slot:header>
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Log</h6>
                        </div>
                        <div class="col-lg-8  d-flex justify-content-end">
                            <a href="{{ route("admin.logs.index") }}" class="btn bg-gradient-primary">
                                Voltar
                            </a>
                        </div>
                    </div>
                </template>
                <template v-slot:body>
                    <div class="row m-2">
                        <p class="col-md-12">{"attributes":{"id":316944,"student_id":62,"contest_id":3,"subject_id":277,"cycle_subject_id":20525,"total_study_time":"02:00:00","completed_time":"01:58:25","min_time":"00:40:00","max_time":"01:19:57","created_at":"2024-03-28T21:49:42.000000Z","updated_at":"2024-04-13T13:01:47.000000Z","deleted_at":null,"is_paused":0},"old":{"id":316944,"student_id":62,"contest_id":3,"subject_id":277,"cycle_subject_id":20525,"total_study_time":"02:00:00","completed_time":"01:59:57","min_time":"00:40:00","max_time":"01:19:57","created_at":"2024-03-28T21:49:42.000000Z","updated_at":"2024-04-13T13:00:15.000000Z","deleted_at":null,"is_paused":0}}</p>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row m-2">
                        <p class="col-md-2">João Pedro</p>
                        <p class="col-md-2">08/12/2024 ás 00:47</p>
                    </div>
                </template>
            </component-card>
        </div>
    </div>
</div>
@endsection
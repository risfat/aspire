@extends('layouts.primary')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <form action="/save-project" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-lg-9 col-12 mx-auto">
                    <div class="card card-body mt-4">
                        <h6 class="mb-0">{{__('New Project')}}</h6>
                        <p class="text-sm mb-0">{{__('Create new project')}}</p>
                        <hr class="horizontal dark my-3">


                        <label for="projectName" class="form-label">{{__('Project Name')}}</label>
                        <input type="text"@if (!empty($project)) value="{{$project->title}}"@endif   name="title" class="form-control" id="projectName">

                        <label class="mt-4 text-sm mb-0">{{__('Project Summary')}}</label>
                        <p class="form-text text-muted text-xs ms-1">
                            {{__('Write a short summary of the project.Within 225 words')}}
                        </p>

                        <div class="form-group">


                            <textarea name="summary" class="form-control" rows="4" id="editor" name="budget">@if (!empty($project)){{$project->summary}}@endif</textarea>
                        </div>

                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">
                                {{__('Status')}}

                            </label><span class="text-danger">*</span>

                            <select class="form-select" aria-label="Default select example" name="status">


                                <option value="Pending"
                                @if(($project->status ?? null) === 'Pending') selected @endif>{{__('Pending')}}</option>
                                <option value="Started"
                                        @if(($project->status ?? null) === 'Started') selected @endif>{{__('Started')}}</option>
                                <option value="Finished"
                                        @if(($project->status ?? null) === 'Finished') selected @endif>{{__('Finished')}}</option>
                            </select>
                        </div>


                        <div class="row mt-4">
                            <div class="col-6">
                                <label class="form-label">{{__('Start Date')}}</label>
                                <input class="form-control" name="start_date" id="start_date" @if(!empty($project))value="{{$project->start_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                    @endif>
                            </div>
                            <div class="col-6">
                                <label class="form-label">{{__('End Date')}}</label>
                                <input class="form-control" name="end_date"  id="end_date"  @if(!empty($project))
                                value="{{$project->end_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                    @endif>
                            </div>
                        </div>




                        <label class="mt-4 text-sm mb-0">{{__('Project Description')}}</label>
                        <p class="form-text text-muted text-xs ms-1">
                            {{__('Write a well organised description of the project.')}}
                        </p>

                        <div class="form-group">
                            <textarea class="form-control" rows="10" id="description" name="description">@if (!empty($project)){{$project->description}}@endif
                            </textarea>
                        </div>
                    @csrf
                        @if($project)
                            <input type="hidden" name="id" value="{{$project->id}}">
                        @endif

                        <div class="d-flex  mt-4">

                            <button type="submit" name="button" class="btn bg-gradient-primary m-0 ">
                                {{__('Save')}}
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection

@section('script')

    <script>
        "use strict";
        $(function () {


            flatpickr("#start_date", {

                dateFormat: "Y-m-d",
            });

            flatpickr("#end_date", {

                dateFormat: "Y-m-d",
            });


            tinymce.init({
                selector: '#description',


                plugins: 'table,code',


            });

        });


    </script>

@endsection


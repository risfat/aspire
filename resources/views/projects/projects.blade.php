@extends('layouts.primary')
@section('content')



    <div class="page-header mb-4 border-radius-xl">
        <span class="mask bg-gradient-dark"></span>
        <div class="container">
            <div class="row">


                <div class="col-lg-6 my-auto">

                    <h5 class="text-white fadeIn2 fadeInBottom mt-4">
                        {{__('“Sooner or later, those who win are those who think they can.”')}}
                    </h5>
                    <p class="text-white opacity-8 fadeIn3 fadeInBottom">{{__('— Paul Tournier')}} </p>
                </div>
            </div>
            <a  href="/create-project" type="button" class="btn bg-gradient-light">{{__('Create Project')}}</a>


        </div>
    </div>


    <div class="container-fluid py-4">
        <section class="py-3">
            <div class="row">
                <div class="col-md-8 me-auto text-left">
                    <h5>{{__('List of your awesome projects')}}</h5>

                </div>
            </div>
            <div class="row mt-lg-4 mt-2">
                @foreach($projects as $project)

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card card-blog ">
                            <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                        <h1 class="text-white">{{$project->title['0']}}</h1>
                                    </div>
                                    <div class="ms-3 my-auto">
                                        <h6>{{$project->title}}</h6>

                                    </div>



                                </div>

                                <p class="text-sm mt-3"> {{$project->summary}} </p>

                                <span class="badge bg-gradient-success font-weight-bold">{{$project->status}}</span>
                                <hr class="horizontal dark">
                                <div class="row">
                                    <div class="col-6 ">
                                        <h6 class="text-sm mb-0">@if(!empty($project->start_date))
                                                {{$project->start_date->format(config('app.date_format'))}}
                                            @endif</h6>
                                        <p class="text-secondary text-sm font-weight-bold mb-0">{{__('Start date')}}</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="text-sm mb-0">@if(!empty($project->end_date))
                                                {{$project->end_date->format(config('app.date_format'))}}
                                            @endif</h6>
                                        <p class="text-secondary text-sm font-weight-bold mb-0">{{__('Due date')}}</p>
                                    </div>
                                    <div class="btn-group">
                                        <a href="/view-project?id={{$project->id}}" type="button" class="btn bg-gradient-dark mt-3">{{__('View')}}</a>
                                        <a href="/create-project?id={{$project->id}}" type="button" class="btn bg-gradient-secondary mt-3">{{__('Edit')}}</a>
                                        <a href="/delete/project/{{$project->id}}" type="button" class="btn bg-gradient-primary mt-3">{{__('Delete')}}</a>

                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                @endforeach




                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <a href="/create-project">
                                <i class="fa fa-plus text-secondary mb-3"></i>
                                <h5 class=" text-secondary">{{__('New project')}} </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection





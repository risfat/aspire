@extends('layouts.primary')
@section('content')

    <div class="page-header mb-4 border-radius-xl">
        <span class="mask bg-gradient-dark"></span>
        <div class="container">
            <div class="row">
                <p class="col-lg-6 my-auto">

                <h5 class="text-white fadeIn2 fadeInBottom mt-4">{{__('Take Actions')}}
                </h5>
                <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">{{__('“Action is the foundational key to all success.”')}}

                </p>
                <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">{{__('– Pablo Picasso')}} </p>
            </div>
            <a  href="/add-task" type="button" class="btn bg-gradient-light mt-4">{{__('Add todays to-dos')}}</a>
            <a  href="/add-task?for=project" type="button" class="btn bg-gradient-light mt-4">{{__('Add Project to-dos')}}</a>
            <a  href="/add-task?for=goal" type="button" class="btn bg-gradient-light mt-4">{{__('Add Goals to-dos')}}</a>


        </div>

    </div>



    <div class="row">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">{{__('Todays to-do list')}}</h6>
                        </div>
                        <ul class="list-group list-group-flush" data-toggle="checklist">
                            @foreach($todos as $todo)


                                <li class="list-group-item border-0 flex-column align-items-start ps-0 py-0 mb-3">
                                    <div class="checklist-item checklist-item-primary ps-2 ms-3">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input todo_checkbox" type="checkbox"
                                                       data-id="{{$todo->id}}"

                                                       @if($todo->completed) checked @endif

                                                >
                                            </div>
                                            <h6 class="mb-0 text-dark font-weight-bold text-sm">{{$todo->title}}</h6>
                                            <div class="dropdown float-lg-end ms-auto pe-4">
                                                <a href="javascript:;" class="cursor-pointer" id="dropdownTable2" data-bs-toggle="dropdown" aria-expanded="false">

                                                    <a class="btn btn-link text-dark px-3 mb-0" href="/add-task/?id={{$todo->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Edit')}}</a>
                                                    <a class="btn btn-link text-dark px-3 mb-0" href="/view-todo/?id={{$todo->id}}"><i class="fas fa-file-alt text-dark me-2" aria-hidden="true"></i>{{__('view')}}</a>

                                                </a>

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                                            <div>
                                                <p class="text-xs mb-0 text-secondary font-weight-bold">{{__('Date')}}</p>
                                                <span class="text-xs font-weight-bolder">{{$todo->date->format(config('app.date_format'))}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="horizontal dark mt-4 mb-0">
                                </li>

                            @endforeach



                        </ul>

                    </div>
                    <hr class="horizontal dark mb-0">
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-12 mt-4 mt-lg-0">
            <div class="card overflow-hidden">
                <div class="card-header p-3 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('Todays Todos')}} </p>
                            <h5 class="font-weight-bolder mb-0">
                               {{$todays_todos}}
                            </h5>
                        </div>

                    </div>
                </div>
                <div class="card-body mt-3 p-0">

                </div>
            </div>
            <div class="card overflow-hidden mt-4">
                <div class="card-header p-3 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                            <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('Projects Todos')}} </p>
                            <h5 class="font-weight-bolder mb-0">
                               {{$project_todos}}
                            </h5>
                        </div>

                    </div>
                </div>
                <div class="card-body mt-3 p-0">

                </div>
            </div>
            <div class="card overflow-hidden mt-4">
                <div class="card-header p-3 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('Goal Todos')}} </p>
                            <h5 class="font-weight-bolder mb-0">
                                {{$goal_todos}}
                            </h5>
                        </div>

                    </div>
                </div>
                <div class="card-body mt-3 p-0">

                </div>
            </div>

        </div>

    </div>






@endsection

@section('script')


<script>
    "use strict";

    $(function () {

        $('.todo_checkbox').on('change',function () {
            let that = $(this);
            if(this.checked)
            {
                $.post('/todos/change-status',{
                    id: that.attr('data-id'),
                    status: 'Completed',
                    _token: '{{csrf_token()}}',
                });
            }
            else{
                $.post('/todos/change-status',{
                    id: that.attr('data-id'),
                    status: 'Not Completed',
                    _token: '{{csrf_token()}}',
                });
            }
        });
    });
</script>


@endsection

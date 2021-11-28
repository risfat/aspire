@extends('layouts.primary')
@section('content')



    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    {{ __('  Add To-dos') }}
                    Add Todos
                    <a href="/todos" type="submit" class="btn bg-gradient-secondary float-end">{{ __('Go to List') }}</a>
                </div>

                <div class="card-body">
                    <form action="/save-todos" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($for === 'project')

                            <div class="mb-3">
                                <label>Project</label>
                                <select class="form-select" name="project_id">
                                    <option value="">--</option>
                                    @foreach($projects as $project)

                                        <option value="{{$project->id}}">{{$project->title}}</option>

                                    @endforeach
                                </select>
                            </div>

                            @elseif($for === 'goal')
                                <label>Goal</label>
                                <select class="form-select" name="goal_id">
                                    <option value="">--</option>
                                    @foreach($goals as $goal)

                                        <option value="{{$goal->id}}">{{$goal->name}}</option>

                                    @endforeach
                                </select>
                            @endif

                        <div class="form-group">
                            <label for="example-date-input" class="form-control-label">{{ __('Date') }}</label>
                            <input class="form-control" name="date" type="date" value="{{date('Y-m-d')}}" id="date">
                        </div>
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">{{ __('Task') }}</label><span class="text-danger">*</span>
                            <input class="form-control"  name="title" type="text" id="title" @if (!empty($todo)) value="{{$todo->title}}"@endif>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1">{{ __('Description') }}</label><span class="text-danger">*</span>
                            <textarea class="form-control" name="description" id="description" rows="3">@if (!empty($todo)) {{$todo->description}}@endif  </textarea>
                        </div>

                        @csrf
                        @if($todo)
                            <input type="hidden" name="id" value="{{$todo->id}}">
                        @endif
                        <button type="submit" class="btn bg-gradient-secondary">{{ __('Save') }}</button>
                        <button type="button" class="btn bg-gradient-primary">{{ __('Close') }}</button>
                    </form>

                </div>

            </div>
        </div>




        @if($for === 'project')

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">{{ __('Project Todo list') }}</h6>
                            </div>

                        </div>
                        <hr class="horizontal dark mb-0">
                    </div>
                    <div class="card-body p-3 pt-0">
                        <ul class="list-group list-group-flush" data-toggle="checklist">
                            @foreach($todos_projects as $todo)


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
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="/delete/today-todo/{{$todo->id}}"><i class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
                                                    <a class="btn btn-link text-dark px-3 mb-0" href="/add-task/?id={{$todo->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Edit')}}</a>
                                                    <a class="btn btn-link text-dark px-3 mb-0" href="/view-todo/?id={{$todo->id}}"><i class="fas fa-file-alt text-dark me-2" aria-hidden="true"></i>{{__('view')}}</a>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center ms-4 mt-3 ps-1">
                                            <div>
                                                <p class="text-xs mb-0 text-secondary font-weight-bold">Date</p>
                                                <span class="text-xs font-weight-bolder">{{$todo->date->format(config('app.date_format'))}}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="horizontal dark mt-4 mb-0">
                                </li>

                            @endforeach



                        </ul>
                    </div>
                </div>

            </div>

        @elseif($for === 'goal')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">{{__('Goal Todo list')}}</h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">

                            </div>
                        </div>
                        <hr class="horizontal dark mb-0">
                    </div>
                    <div class="card-body p-3 pt-0">
                        <ul class="list-group list-group-flush" data-toggle="checklist">
                            @foreach($todos_goals as $todo)


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
                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="/delete/today-todo/{{$todo->id}}"><i class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
                                                <a class="btn btn-link text-dark px-3 mb-0" href="/add-task/?id={{$todo->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Edit')}}</a>
                                                <a class="btn btn-link text-dark px-3 mb-0" href="/view-todo/?id={{$todo->id}}"><i class="fas fa-file-alt text-dark me-2" aria-hidden="true"></i>{{__('view')}}</a>
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
                </div>

            </div>


        @elseif($for === null)
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-3">
                        <h6 class="mb-0">{{__('To do list')}}</h6>
                        <hr class="horizontal dark mb-0">
                    </div>
                    <div class="card-body p-3 pt-0">
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
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="/delete/today-todo/{{$todo->id}}"><i class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
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
                </div>

            </div>





        @endif



    </div>






@endsection


@section('script')


    <script>
        "use strict";
        $(function () {


            flatpickr("#date", {

                dateFormat: "Y-m-d",
            });



        });




    </script>

    <script>
        tinymce.init({
            selector: '#description',


            plugins: 'table,code',


        });
    </script>
    <script>
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





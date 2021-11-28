@extends('layouts.primary')


@section('content')


    <div class="page-header mb-4 border-radius-xl">
        <span class="mask bg-gradient-dark"></span>
        <div class="container">
            <div class="row">
                <p class="col-lg-6 my-auto">
                    <h5 class="text-white fadeIn2 fadeInBottom mt-4">
                    {{__('Realise your Dreams')}}
                    </h5>
                    <p class="text-white opacity-8 fadeIn3 fadeInBottom">
                        {{__('You must form a clear and definite mental picture of what you want.')}}

                    </p>
                <p class=" text-white opacity-8 fadeIn3 fadeInBottom">
                    {{__('— The science of getting rich')}}
                </p>
                </div>
            <a  href="/set-goal" type="button" class="btn btn-outline-light">
                {{__('Set your goals')}}

            </a>
            </div>


        </div>


    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{__('Goals')}}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Name')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    {{__('Estimate Date to finish')}}
                                </th>
                                <th class="text-center float-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{__('Completed?')}}

                                </th>

                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($goals as $goal)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$goal->name}}</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <span class="text-xs font-weight-bold">{{$goal->date->format(config('app.date_format'))}}</span>

                                    </td>

                                    <td class="align-right text-sm">
                                        <div class="form-check float-end ">
                                            <input class="form-check-input goal_checkbox" type="checkbox"
                                                   data-id="{{$goal->id}}"

                                                   @if($goal->completed) checked @endif

                                            >

                                        </div>
                                    </td>

                                    <td class="">
                                        <div class="ms-auto text-end">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="/view-goal?id={{$goal->id}}"><i class="fas fa-file-alt text-dark me-2" aria-hidden="true"></i>{{__('View')}}</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="/set-goal?id={{$goal->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>{{__('Edit')}}</a>

                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="/delete/goal/{{$goal->id}}"><i class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach






                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>







@endsection




@section('script')
    <script>
        "use strict"
        $(function () {
            $('.goal_checkbox').on('change',function () {
                let that = $(this);
                if(this.checked)
                {
                    $.post('/goals/change-status',{
                        id: that.attr('data-id'),
                        status: 'Completed',
                        _token: '{{csrf_token()}}',
                    });
                }
                else{
                    $.post('/goals/change-status',{
                        id: that.attr('data-id'),
                        status: 'Not Completed',
                        _token: '{{csrf_token()}}',
                    });
                }
            });
        });
    </script>


@endsection



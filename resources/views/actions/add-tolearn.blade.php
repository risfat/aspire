@extends('layouts.primary')


@section('content')


    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                {{__('Add Things to Learn')}}
            </div>

            <div class="card-body">
                <form action="/save-to-learn" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">{{__('What topic do you want to learn')}}</label><span class="text-danger">*</span>
                        <input class="form-control" type="text" name="title" @if (!empty($to_learn)) value="{{$to_learn->title}}" @endif id="example-text-input">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-date-input" class="form-control-label">{{__('Start Date')}}</label>
                                <input class="form-control" name="start_date"  id="start_date"
                                       @if(!empty($to_learn))
                                value="{{$to_learn->start_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                @endif>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-date-input" class="form-control-label">{{__('End Date')}}</label>
                                <input class="form-control" name="end_date"  id="end_date" @if(!empty($to_learn))
                                value="{{$to_learn->end_date}}"
                                       @else
                                       value="{{date('Y-m-d')}}"
                                @endif>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{__('Description')}}</label>
                        <textarea class="form-control" name="description" id="description" rows="10">@if (!empty($to_learn)){{$to_learn->description}}@endif</textarea>
                    </div>

                     @csrf
                    @if($to_learn)
                        <input type="hidden" name="id" value="{{$to_learn->id}}">
                    @endif
                    <button type="submit" class="btn bg-gradient-secondary">{{__('Save')}}</button>
                    <button type="button" class="btn bg-gradient-primary">{{__('Close')}}</button>
                </form>

            </div>

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


                plugins: 'table,code,advlist',


            });
        });


    </script>

@endsection







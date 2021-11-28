@extends('layouts.primary')
@section('content')
    <div class="page-header mb-4 border-radius-xl" >
        <span class="mask bg-gradient-dark"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 my-auto">

                    <h5 class="text-white fadeIn2 fadeInBottom mt-4">{{__('Taking good notes help you learn more.')}}
                    </h5>

                </div>
            </div>

            <a href="/add-note" type="button" class="btn bg-gradient-light">{{__('Take New Note')}}</a>

        </div>
    </div>

    <div class="row">
        @foreach($notes as $note)
            <div class="col-md-6 mb-4">
                <div class="card">


                    <div class="card-body">
                        <p class="text-gradient text-primary text-gradient font-weight-bold text-sm text-uppercase">{{$note->topic}}</p>
                        <a href="javascript:;">
                            <h5>
                                {{$note->title}}
                            </h5>
                        </a>
                        <p class="text-muted">{{$note->updated_at->format(config('app.date_format'))}}</p>

                        <div class="d-flex mt-5">

                            <a href="/view-note?id={{$note->id}}" class="btn btn-outline-secondary rounded-circle p-2 mx-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Pause">
                                <i class="fas fa-file p-2"></i>
                            </a>
                            <a href="/add-note?id={{$note->id}}" class="btn btn-outline-dark rounded-circle p-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next">
                                <i class="fas fa-pen p-2"></i>
                            </a>
                            <a href="/delete/note/{{$note->id}}" class="btn btn-outline-primary rounded-circle p-2 mx-2 mb-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev">
                                <i class="fas fa-trash p-2"></i>
                            </a>
                        </div>



                    </div>



                </div>

            </div>
        @endforeach



    </div>







@endsection

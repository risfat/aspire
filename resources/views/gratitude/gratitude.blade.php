@extends('layouts.primary')
@section('content')




    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-2">
                            {{__('My Daily Journals')}}
                        </h6>
                        <span>
</span>
                        <p class="mb-0 text-sm">
                            {{__('Free your mind from the noise of thousands of thoughts and set your intention for the day. This practice has proven to be the most effective in terms of productivity and mental peace.')}}
                        </p>
                        <a  href="/add-five-min-journal" type="button" class="btn bg-gradient-dark mt-4">{{__('New Five Minute Journal')}}</a>

                    </div>

                    <div class="card-body ">

                        <div class="row">



                            @foreach($journals as $journal)
                                <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0 mb-4">
                                    <div class="card text-center">
                                        <div class="overflow-hidden bg-gradient-secondary  position-relative border-radius-lg bg-cover p-3">
                                            <span class=" bg-gradient-light opacity-6"></span>
                                            <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                                                <h4 class="text-white">{{__('5 Minute Journal')}}</h4>
                                                <h4 class="text-white">{{$journal->date->format(config('app.date_format'))}}</h4>
                                                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-4" href="/view-journal?id={{$journal->id}}">
                                                    {{__('Read More')}}
                                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                                </a>
                                                <div class="mt-4">
                                                    <a href="/add-five-min-journal?id={{$journal->id}}" type="button" class="btn btn-outline-light">
                                                        {{__('Edit')}}

                                                    </a>
                                                    <a href="/delete/journal/{{$journal->id}}" type="button" class="btn btn-light">{{__('Delete')}}</a>

                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@extends('layouts.primary')


@section('content')

<div class="row">
    <div class="card">
        <div class="card-header">

            <span class="float-end">
                 <a  href="/gratitude" type="button" class="btn bg-gradient-dark mt-4">{{__('Go back to list')}}</a>
            </span>
            <h4> {{__('Journal of  - ')}}{{$journal->date}}</h4>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <h5>{{__('2 things I am grateful for')}}</h5>



                    </li>
                    <p> {!!clean($journal->grateful)!!}</p>

                </div>
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">    <h5>{{__('What would make me feel great today')}}</h5>


                    </li>
                    <p> {!!clean($journal->feeling)!!}</p>


                </div>


            </div>
            <div class="row">
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">     <h5>{{__('Daily affirmations')}}</h5>


                    </li>
                    <p> {!!clean($journal->affirmations)!!}</p>

                </div>
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">       <h5>{{__('Favorite things of my day')}}</h5>



                    </li>
                    <p> {!!clean($journal->fav_things)!!}</p>


                </div>


            </div>
            <div class="row">
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">    <h5>
                            {{__('What can i do today that will bring me closer to my dream')}}
                        </h5>

                    </li>
                    <p>{!!clean($journal->dream)!!}</p>

                </div>
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">   <h5>{{__('What positive habit i have developed')}}</h5>

                    </li>
                    <p> {!!clean($journal->habit)!!}</p>


                </div>


            </div>
            <div class="row">
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">    <h5>{{__('I should not waste time on')}}</h5>

                    </li>
                    <p> {!!clean($journal->dont_waste)!!}</p>

                </div>
                <div class="col-md-6">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">   <h5>{{__('What are the things i must accomplish today (Non-Negotiable)')}}</h5>


                    </li>
                    <p> {!!clean($journal->must_accomplish)!!}</p>


                </div>


            </div>



        </div>
    </div>



</div>

@endsection

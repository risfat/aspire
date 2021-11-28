
@extends('layouts.primary')


@section('content')
    <div class="card">
        <div class="card-header">
           <h6>{{__('5 Minute Daily Journal/ Meditation')}}</h6>
            <p class="form-text text-muted text-xs">
                {{__('Have a concious intentional coversation with yourself')}}
            </p>
            <p class="text-sm">
                {{__('Start your day by saying')}}

            </p>
            <h6>{{__('Today is going to be a great day')}}<span><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="30px" height="28px"><path fill="#FFF59D" d="M24 2A20 20 0 1 0 24 42A20 20 0 1 0 24 2Z"/><path fill="#FBC02D" d="M37,22c0-7.7-6.6-13.8-14.5-12.9c-6,0.7-10.8,5.5-11.4,11.5c-0.5,4.6,1.4,8.7,4.6,11.3c1.4,1.2,2.3,2.9,2.3,4.8V37h12v-0.1c0-1.8,0.8-3.6,2.2-4.8C35.1,29.7,37,26.1,37,22z"/><path fill="#FFF59D" d="M30.6,20.2l-3-2c-0.3-0.2-0.8-0.2-1.1,0L24,19.8l-2.4-1.6c-0.3-0.2-0.8-0.2-1.1,0l-3,2c-0.2,0.2-0.4,0.4-0.4,0.7s0,0.6,0.2,0.8l3.8,4.7V37h2V26c0-0.2-0.1-0.4-0.2-0.6l-3.3-4.1l1.5-1l2.4,1.6c0.3,0.2,0.8,0.2,1.1,0l2.4-1.6l1.5,1l-3.3,4.1C25.1,25.6,25,25.8,25,26v11h2V26.4l3.8-4.7c0.2-0.2,0.3-0.5,0.2-0.8S30.8,20.3,30.6,20.2z"/><path fill="#5C6BC0" d="M24 41A3 3 0 1 0 24 47A3 3 0 1 0 24 41Z"/><path fill="#9FA8DA" d="M26,45h-4c-2.2,0-4-1.8-4-4v-5h12v5C30,43.2,28.2,45,26,45z"/><path fill="#5C6BC0" d="M30 41l-11.6 1.6c.3.7.9 1.4 1.6 1.8l9.4-1.3C29.8 42.5 30 41.8 30 41zM18 38.7L18 40.7 30 39 30 37z"/></svg></span></h6>

        </div>




        <div class="card-body">
            <form action="/save-journal" method="post">
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
                    <label for="example-date-input" class="form-control-label">
                        {{__('Today')}}

                    </label>
                    <span class="text-danger">*</span>
                    <input class="form-control"  name="date" type="date" value="{{date('Y-m-d')}}" id="date"
                           @if(!empty($journal))
                           value="{{$journal->date}}"
                           @else
                           value="{date('Y/m/d')}"
                        @endif>
                </div>






                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__(' 2 Things I am grateful for')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__(' Write 2 to 3 things you are grateful for. Gratitude has a tremendous effect on your well-being.')}}
                            </p>
                            <textarea name="grateful" class="form-control" id="grateful" rows="10">@if (!empty($journal)){{$journal->grateful}}@endif</textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                               {{__('What would make me feel great today')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write 2 to 3 things that would make you feel great such as taking a long walk or reading a book with a warm cup of tea or coffee.')}}
                            </p>
                            <textarea class="form-control" id="feeling" name="feeling" rows="10">@if (!empty($journal)){{$journal->feeling}}@endif</textarea>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('Daily Affirmations')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write positive affirmations such as I can make my dreams come true, and I am worthy of Greatness.')}}

                            </p>
                            <textarea class="form-control" name="affirmations" id="affirmations" rows="10">@if (!empty($journal)){{$journal->affirmations}}@endif</textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                               {{__('Favorite Things of my day')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write 2 to 3 favorite things of your day, such as after a busy workday, you like to take a long shower with scented shower gel, talking to your friends and family, coming up with incredible ideas, etc.')}}
                            </p>
                            <textarea class="form-control" name="fav_things" id="fav_things" rows="10">@if (!empty($journal)){{$journal->fav_things}}@endif</textarea>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('What can i do today that will bring me closer to my dream')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write a short note on what actions you can take today that will bring you closer to your goals. That could be that you want to lose weight. So today you can do a 20-minute exercise, or you want to start a new company you can study how can you register a company. Etc. The more specific your thought, the nearer you are to accomplish your dreams.')}}

                            </p>
                            <textarea class="form-control" name="dream" id="dream" rows="10">@if (!empty($journal)){{$journal->dream}}@endif</textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('What positive habit i have developed')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Did you develop any positive habits such as waking up early, stop wasting time on social media, etc.? If yes, write those down. Keep track of that. It will save your life.')}}
                            </p>
                            <textarea class="form-control" name="habit" id="habit" rows="10">@if (!empty($journal)){{$journal->habit}}@endif</textarea>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('I should not waste time on')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write the things you dont want to waste your valuable time on, such as you might want to not waste time on negative thinking and avoid negative people. You might also want to reduce the amount of time you spend on social media.')}}

                            </p>
                            <textarea class="form-control" name="dont_waste" id="dont_waste" rows="10">@if (!empty($journal)){{$journal->dont_waste}}@endif</textarea>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">
                                {{__('What are the things I must accomplish today(Non-Negotiable)')}}
                            </label>
                            <p class="form-text text-muted text-xs ms-1">
                                {{__('Write the things you must do, such as paying specific bills, take a 30-minute walk. Do five-minute meditation, etc.')}}
                            </p>
                            <textarea class="form-control" name="must_accomplish" id="must_accomplish" rows="10">@if (!empty($journal)){{$journal->must_accomplish}}@endif</textarea>
                        </div>

                    </div>
                </div>


                @if($journal)
                    <input type="hidden" name="id" value="{{$journal->id}}">
                @endif

                @csrf
                <button type="submit" class="btn bg-gradient-secondary">{{__('Save')}}</button>
                <button type="button" class="btn bg-gradient-secondary">{{__('Close')}}</button>
            </form>


        </div>


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
            selector: '#grateful',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#feeling',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#affirmations',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#fav_things',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#dream',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#habit',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#dont_waste',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
        tinymce.init({
            selector: '#must_accomplish',

            plugins: 'lists,table',
            toolbar: 'numlist bullist',
            lists_indent_on_tab: false


        });
    </script>

@endsection













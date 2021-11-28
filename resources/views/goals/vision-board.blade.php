@extends('layouts.primary')



@section('content')

    <form action="/vision-board" class="form-control dropzone" id="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>



    <!-- Gallery -->


    <div class="row mt-4" data-masonry='{"percentPosition": true }'>
        @foreach($images as $image)
        <div class="col-md-4 mb-4">

            <div class="card">
                <div class="card-body">
                    <img
                        src="{{asset(PUBLIC_DIR.'/storage/'.$image->path)}}"
                        class="w-100 shadow-1-strong rounded mb-3"
                        alt=""
                    />
                    <a  href="/delete/image/{{$image->id}}" class="btn btn-outline-dark rounded-circle p-2 mb-0" type="button">
                        <i class="fas fa-trash p-2"></i>
                    </a>
                </div>
            </div>





        </div>
        @endforeach



    </div>



@endsection




@section('script')
    <script>
        "use strict"

        Dropzone.autoDiscover = false;
        Dropzone.options.dropzone = {
            acceptedFiles:'image/*'
        };

        $(function () {
            $("#dropzone").dropzone({
                url: "/vision-board",
                success: function (file, response) {
                    location.reload();
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                sending: function(file, xhr, formData){
                    formData.append('_token', '{{csrf_token()}}');
                }
            });
        })
    </script>

@endsection



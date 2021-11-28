@extends('layouts.primary')
@section('content')


    <form action="/document" class="form-control dropzone" id="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>



    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{__('Uploaded Documents')}}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">


                        @foreach($documents as $document)

                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">

                                    <h6 class="mb-3 text-sm">{{$document->name}}</h6>

                                </div>
                                <div class="ms-auto">

                                    <a  href="/download/{{$document->id}}" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-download text-lg me-1"></i>{{__('Download')}}</a>
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="/delete/document/{{$document->id}}"><i class="far fa-trash-alt me-1 text-lg"></i>{{__('Delete')}}</a>

                                </div>
                            </li>
                        @endforeach



                    </ul>
                </div>
            </div>
        </div>




@endsection


@section('script')
<script>

    "use strict"

    Dropzone.autoDiscover = false;
    Dropzone.options.dropzone = {
        acceptedFiles: "image/*,application/pdf",
    };

    $(function () {

        $("#dropzone").dropzone({
            url: "/document",
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



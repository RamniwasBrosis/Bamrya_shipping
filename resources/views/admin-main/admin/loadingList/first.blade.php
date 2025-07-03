@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Loading List</h5>
            </li>
        </ol>
        <a class="text-primary fs-13" href="{{ url('admin/export-bl-entry') }}">Go -></a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" id="loadingList" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 my-2">
                                        <label for="">Vessel Name</label>
                                        <select class="default-select form-control wide me-2" name="vessel_id">
                                            <option value="">Select</option>
                                            @foreach ($vessels as $vessel)
                                                <option value="{{$vessel->id}}">{{$vessel->vessel_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-6 my-2">
                                        <label for="">Voy_no</label>
                                        <input type="text" class="form-control" name="voy_no">
                                    </div>
                                    <div class="col-xl-6 my-2">
                                        <label for="">Terminal Port</label>
                                        <select class="default-select form-control wide me-2" name="terminal_port">
                                            <option value="">Select</option>
                                            <option value="BMCT">NHAVA SHEVA BMCT</option>
                                            <option value="NSICT">NHAVA SHEVA NSICT</option>
                                            <option value="NSIGT">NHAVA SHEVA NSIGT</option>
                                            <option value="GTI">NHAVA SHEVA GTI</option>
                                            <option value="NSFT">NHAVA SHEVA NSFT</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 my-2 pt-5 text-center">
                                        <button class="btn btn-primary me-md-2 btn-sm" type="submit">PREVIEW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   <div id="reportPreview" class="mt-4 bg-slate-400 p-3 border border-dark" style="display: none;" ></div>
                </div>                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
 
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        $(document).ready(function(){

            $('#loadingList').on('submit', function(e){
                e.preventDefault();

                var data = $(this).serialize();
                $.ajax({
                    url: '{{route('loading-list.preview')}}',
                    type: 'post',
                    data: data,
                    success: function(res){
                        $('#reportPreview').css('display', 'block').html(res.html);
                    },
                    error: function(xhr){
                        alert('An error occurred while fetching data.');
                console.log(xhr.responseText);
                    }
                });
            });
            
        });
    </script>
@endpush

@extends('admin-main.layouts.default')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Loading List</h5>
            </li>
        </ol>
        <a class="text-primary fs-13" href="#">Go -></a>
    </div>
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" id="purchaseList" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 my-2">
                                        <label for="">Party Name</label>
                                        <select class="form-control wide me-2 select2" name="billing_party_id">
                                            <option value="">Select</option>
                                            @foreach ($uniqueParties as $party)
                                                @if($party)
                                                    <option value="{{ $party->id }}">{{ $party->party_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-xl-6 my-2 pt-5 text-center">
                                        <button class="btn btn-primary me-md-2 btn-md" type="submit">PREVIEW</button>
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
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Select a value',
                'allowClear': true,
                width: '100%'
            })
        })
    </script>
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

            $('#purchaseList').on('submit', function(e){
                e.preventDefault();
            
                let party = $('select[name="billing_party_id"]').val();
            
                if (!party) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Select Party',
                        text: 'Please select a party before previewing.'
                    });
                    return; // STOP submitting
                }
            
                var data = $(this).serialize();
            
                $.ajax({
                    url: '{{ route("purhcasePayment-list.preview") }}',
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

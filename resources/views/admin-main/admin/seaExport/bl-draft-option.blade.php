@extends('admin-main.layouts.default')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="text-center text-primary fw-bold mb-4">
                MULTIMODAL TRANSPORT DOCUMENT :
            </h4>

            <form id="hblForm" action="{{ route('sea.way.bill', $id) }}" method="GET" target="_blank">
                @csrf
                <div class="row">
                    <!-- Left side: HBL Type -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">HBL Type:</label>

                        <div class="d-flex flex-column gap-2">
                            @php
                                $hblTypes = [
                                    'DRAFT',
                                    'NON-NEGOTIABLE',
                                    'SEA WAY B/L',
                                    'ORIGINAL',
                                    '1st ORIGINAL',
                                    '2nd ORIGINAL',
                                    '3rd ORIGINAL',
                                ];
                            @endphp
    
                            @foreach($hblTypes as $type)
                                <div class="form-check">
                                    <input type="radio" name="hbl_type" id="{{ Str::slug($type) }}"
                                           value="{{ $type }}" class="form-check-input"
                                           {{ $loop->first ? 'checked' : '' }}>
                                    <label for="{{ Str::slug($type) }}"
                                            class="form-check-label fw-semibold {{ $loop->first ? 'text-primary' : '' }}">
                                        {{ $type }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                    <!-- Right side: Inputs and Button -->
                    <div class="col-md-8 mt-3 mt-md-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-6 col-md-4">
                                <label for="issue_date" class="form-label fw-semibold">Issue Date:<span class="text-danger">*</span></label>
                                <input type="date" name="issue_date" id="issue_date" class="form-control"
                                       placeholder="Issue Date" required value="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <label for="freight_payable" class="form-label fw-semibold">Freight Payable at:</label>
                                <input type="text" name="freight_payable" id="freight_payable" class="form-control"
                                       placeholder="Freight Payable">
                            </div>

                            <div class="col-12 col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-info text-white fw-bold w-100">
                                    SHOW REPORT
                                </button>
                                <button type="button" id="downloadDocx" class="btn btn-success text-white fw-bold w-100">
                                    DOWNLOAD WORD
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        // Change label color when radio is selected
        $('input[name="hbl_type"]').change(function(){
            $('input[name="hbl_type"]').each(function(){
                $('label[for="'+$(this).attr('id')+'"]').removeClass('text-primary');
            });
            $('label[for="'+$(this).attr('id')+'"]').addClass('text-primary');
        });
        
        // Optional: AJAX version if you want to display inline
        $('#hblForm').on('submit', function(e){
            // If you want to open in new tab, remove this
            // e.preventDefault();
            
            // Optional: Show loading
            // $('#draftResult').html('<div class="text-center"><div class="spinner-border"></div></div>');
            
            // If you want AJAX version, uncomment below
            /*
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('sea.way.bill', $id) }}",
                method: "GET",
                data: $(this).serialize(),
                success: function(response){
                    $('#draft-container').removeClass('d-none').addClass('d-block');
                    $('#draftResult').html(response.html);
                },
                error: function(xhr){
                    console.error(xhr.responseText);
                    alert("Something went wrong.");
                }
            });
            */
        });
    });
</script>
<script>
$('#downloadDocx').on('click', function () {
    var $btn = $(this);
    var originalText = $btn.html();
    $btn.html('<i class="fas fa-spinner fa-spin"></i> Generating...').prop('disabled', true);
    
    let formData = $('#hblForm').serialize();
    let url = "{{ route('sea.way.bill.docx', $id) }}?" + formData;
    
    // Use fetch to handle potential errors
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.blob();
    })
    .then(blob => {
        const link = document.createElement('a');
        const blobUrl = URL.createObjectURL(blob);
        link.href = blobUrl;
        link.download = 'Sea_Way_Bill.docx';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(blobUrl);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to generate Word document: ' + (error.error || 'Unknown error'));
    })
    .finally(() => {
        $btn.html(originalText).prop('disabled', false);
    });
});
</script>
@endpush
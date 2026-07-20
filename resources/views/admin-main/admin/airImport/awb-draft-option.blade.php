@extends('admin-main.layouts.default')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="text-center text-primary fw-bold mb-4">
                MULTIMODAL TRANSPORT DOCUMENT :
            </h4>

            <form id="hblForm">
                @csrf
                <div class="row">
                    <!-- Left side: HBL Type -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">HBL Type:</label>

                        <div class="d-flex flex-column gap-2">
                            @php
                                $hblTypes = [
                                    'All',
                                    'ORIGINAL 1 (FOR ISSUING CARRIER)',
                                    'ORIGINAL 2 (FOR CONSIGNEE)',
                                    'ORIGINAL 3 (FOR SHIPPER)',
                                    'COPY 4 (DELIVERY RECEIPT)',
                                    'COPY 5 (FOR AIRPORT OF DESTINATION)',
                                    'COPY 6 (FOR THIRD CARRIER)',
                                    'COPY 9 (FOR AGENT)',
                                    'COPY 10 (EXTRA COPY FOR CARRIER)',
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
                                <label for="issue_date" class="form-label fw-semibold">Issue Date:</label>
                                <input type="date" name="issue_date" id="issue_date" class="form-control" required
                                       placeholder="Issue Date" value="{{ now()->format('Y-m-d') }}">
                            </div>
    
                            <div class="col-sm-6 col-md-4">
                                <label for="issuedPlace" class="form-label fw-semibold">Issue Place:</label>
                                <input type="text" name="issuedPlace" id="issuedPlace" class="form-control" required
                                       placeholder="Issue Place">
                            </div>

                            <div class="col-12 col-md-4 d-flex align-items-end">
                                <button type="submit" id="showReportBtn" class="btn btn-info text-white fw-bold w-100">
                                    Generate AirWay Bill
                                </button>
                                
                                 <button type="button" id="downloadAllPdf" class="btn btn-warning ms-1 fs-6 d-none">
                                    Download All AirWay Bill
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    
    <div class="mt-4">
        <div id="draftResult" style="width: 100%; margin: auto;">
            
        </div>
        <div id="draft-container" class="d-none">
            <button type="button" id="downloadPdf" class="btn btn-primary">Download PDF</button>
            <!--<button type="button" id="downloadWord" class="btn btn-success ms-2">Download Word</button>-->
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/FileSaver.min.js') }}"></script>
    <script src="{{ asset('js/html-docx.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.1/html-docx.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>-->

    <script>
        $(document).ready(function(){
            
            function showPdfLoader(title = 'Generating PDF') {
                Swal.fire({
                    title: title,
                    html: 'Please wait, your document is being prepared…',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
            
            function hidePdfLoader() {
                Swal.close();
            }
        
            function toggleButtons() {
                let selectedType = $('input[name="hbl_type"]:checked').val();
        
                if (selectedType === 'All') {
                    // If "All" is selected
                    $('#showReportBtn').addClass('d-none'); 
                    $('#downloadAllPdf').removeClass('d-none'); 
                } else {
                    // If any other HBL type selected
                    $('#showReportBtn').removeClass('d-none'); 
                    $('#downloadAllPdf').addClass('d-none');  
                }
            }
        
            // Run when page loads
            toggleButtons();
        
            // Run when user changes selection
            $('input[name="hbl_type"]').change(function() {
                toggleButtons();
            });
            
            
            
            $('#hblForm').on('submit', function(e){
                e.preventDefault();
                
                $("#showReportBtn").text("Generating...").attr("disabled", true);
        
                $.ajax({
                    url: "{{ route('awb.draft.generate.import', $id) }}",
                    method: "POST",
                    data: $(this).serialize() + '&download=pdf',
                    success: function(response){
                        $('#draft-container').removeClass('d-none').addClass('d-block');
                        $('#draftResult').html(response.html);
                        
                        $('#pdfHTML').removeClass('d-none').addClass('d-block');
                        
                        $("#showReportBtn").text("Generate AirWay Bill").attr("disabled", false);
                        
                    },
                    error: function(xhr){
                        console.error(xhr.responseText);
                        alert("Something went wrong.");
                    }
                });
            });

            $('input[name="hbl_type"]').change(function(){
                $('input[name="hbl_type"]').each(function(){
                    $('label[for="'+$(this).attr('id')+'"]').removeClass('text-primary');
                });
                $('label[for="'+$(this).attr('id')+'"]').addClass('text-primary');
            });
            
            $(document).on("click", "#downloadPdf", async function () {

                const btn = $(this);
                btn.text("Downloading...").attr("disabled", true);
            
                showPdfLoader('Downloading AirWay Bill');
            
                try {
                    const source = document.getElementById("draftResult");
            
                    const printContent = document.createElement("div");
                    printContent.style.width = "210mm";
                    printContent.style.minHeight = "297mm";
                    printContent.style.padding = "5mm";
                    printContent.style.background = "#ffffff";
                    printContent.innerHTML = source.innerHTML;
            
                    const opt = {
                        margin: 0,
                        filename: 'Air-Import-Draft-' + Date.now() + '.pdf',
                        image: { type: 'jpeg', quality: 3 },
                        html2canvas: {
                            scale: 8,
                            useCORS: true,
                            scrollY: 0
                        },
                        jsPDF: {
                            unit: 'mm',
                            format: 'a4',
                            orientation: 'portrait'
                        }
                    };
                    
                    const permission = await $.ajax({
                        url: "{{ route('air.import.mawb.check.download') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            job_no: "{{ $airImportDraftData->job_no }}",
                            copy_type: $('input[name="hbl_type"]:checked').val()
                        }
                    });
                    
                    if(!permission.status){
                        Swal.fire(
                            "Download Limit",
                            permission.message,
                            "warning"
                        );
                        return;
                    }
            
                    await html2pdf().set(opt).from(printContent).save();
                    
                    await $.ajax({
                        url: "{{ route('air.import.mawb.confirm.download') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            job_no: "{{ $airImportDraftData->job_no }}",
                            copy_type: $('input[name="hbl_type"]:checked').val()
                        }
                    });
            
                    hidePdfLoader();
            
                    Swal.fire({
                        icon: 'success',
                        title: 'Downloaded',
                        text: 'AirWay Bill downloaded successfully'
                    });
            
                } catch (err) {
                    hidePdfLoader();
                    Swal.fire('Error', 'Download failed or Download Limit Exceeded!', 'error');
                }
            
                btn.text("Download PDF").attr("disabled", false);
            });
            
            $(document).on("click", "#downloadAllPdf", async function () {
                
                $(this).text('Downloading.....').attr('disabled', true);

                const hblTypes = [
                    'ORIGINAL 3 (FOR SHIPPER)',
                    'COPY 9 (FOR AGENT)',
                    'ORIGINAL 1 (FOR ISSUING CARRIER)',
                    'COPY 10 (EXTRA COPY FOR CARRIER)',
                    'ORIGINAL 2 (FOR CONSIGNEE)',
                    'COPY 4 (DELIVERY RECEIPT)',
                    'COPY 5 (FOR AIRPORT OF DESTINATION)',
                    'COPY 6 (FOR THIRD CARRIER)'
                ];
                
                for (const type of hblTypes) {
                    try {
                        await $.ajax({
                            url: "{{ route('air.import.mawb.check.download') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                job_no: "{{ $airImportDraftData->job_no }}",
                                copy_type: type
                            }
                        });
                    } catch (xhr) {
                        let message = "Download limit reached.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: "warning",
                            title: "Download Blocked",
                            text: message
                        });
                
                        $(this)
                            .text('Download All AirWay Bill')
                            .prop('disabled', false);
                
                        return;
                    }
                
                }
            
                const issueDate   = $('#issue_date').val();
                const issuedPlace = $('#issuedPlace').val();
                /* issue Date validation */
                if (!issueDate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Issue Date Required',
                        text: 'Please select Issue Date',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            
                /* Issue Place validation */
                if (!issuedPlace || !issuedPlace.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Issue Place Required',
                        text: 'Please enter Issue Place',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            
                const url = "{{ route('awb.draft.generate.import', $id) }}";
                let combinedHTML = '';
                
                for (let i = 0; i < hblTypes.length; i++) {
                    try {
                        const response = await $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                hbl_type: hblTypes[i],
                                issue_date: issueDate,
                                issuedPlace: issuedPlace
                            }
                        });
            
                        combinedHTML += `
                            <div style="
                                page-break-after: always;
                                page-break-inside: avoid;
                                width: 210mm;
                                min-height: 297mm;
                                background: #fff;
                                padding: 6mm;
                            ">
                                ${response.html}
                            </div>
                        `;
                
                    } catch (err) {
                        console.error('Error generating:', hblTypes[i], err);
                    }
                }
                
                const tempContainer = document.createElement('div');
                tempContainer.style.width = '210mm';
                tempContainer.innerHTML = combinedHTML;
            
                const opt = {
                    margin: 0,
                    filename: 'ALL_HBL_COPIES_' + Date.now() + '.pdf',
                    image: { type: 'jpeg', quality: 3 },
                    html2canvas: {
                        scale: 3.5,
                        useCORS: true,
                        scrollY: 0
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };
            
                await html2pdf().set(opt).from(tempContainer).save();
                
                for (const type of hblTypes) {
                    await $.ajax({
                        url: "{{ route('air.import.mawb.confirm.download') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            job_no: "{{ $airImportDraftData->job_no }}",
                            copy_type: type
                        }
                    });
                }
                $(this).text('Download All Airway Bill').attr('disabled', false);
            });

            
        });
    </script>

@endpush
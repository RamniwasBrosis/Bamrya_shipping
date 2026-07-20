@extends('admin-main.layouts.default')

@push('style')
<style>
  #draftResult {
    page-break-after: avoid;
  }
  #draftResult > div:last-child {
    page-break-after: auto !important;
  }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="text-center text-primary fw-bold mb-4">
                House Air Way Bill
            </h4>

            <form id="hblForm">
                @csrf
                <div class="row">
                    <input type="hidden" name="hawb_type" value="hawb">
                    <!-- Left side: HBL Type -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">HBL Type:</label>

                        <div class="d-flex flex-column gap-2">
                            @php
                                $hblTypes = [
                                    'All',
                                    'ORIGINAL 3 (FOR SHIPPER)',
                                    'COPY 9 (FOR AGENT)',
                                    'ORIGINAL 1 (FOR ISSUING CARRIER)',
                                    'COPY 10 (EXTRA COPY FOR CARRIER)',
                                    'ORIGINAL 2 (FOR CONSIGNEE)',
                                    'COPY 4 (DELIVERY RECEIPT)',
                                    'COPY 5 (FOR AIRPORT OF DESTINATION)',
                                    'COPY 6 (FOR THIRD CARRIER)'
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
                                <label for="freight_payable" class="form-label fw-semibold">Freight Payable at:</label>
                                <input type="text" name="freight_payable" id="freight_payable" class="form-control" required
                                       placeholder="Freight Payable">
                            </div>
    
                            <div class="col-12 col-md-4 d-flex align-items-end">
                                <button type="submit" id="showReportBtn" class="btn btn-info text-white fw-bold w-100">
                                    SHOW REPORT
                                </button>
                                
                                 <button type="button" id="downloadAllPdf" class="btn btn-warning ms-2 d-none">
                                    Download All PDFs
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-4">
        <div id="draftResult" style="margin: auto;"></div>
        <div id="draft-container" class="d-none">
            <button type="button" id="downloadPdf" class="btn btn-primary">Download PDF</button>
            <!--<button type="button" id="downloadWord" class="btn btn-success ms-2">Download Word</button>-->
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.1/html-docx.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <script>
        $(document).ready(function(){
            
            function showPdfLoader(title = 'Generating PDF') {
                Swal.fire({
                    title: title,
                    html: 'Please wait, preparing your document…',
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
                
                $('#showReportBtn').text('Downloading PDF').prop('disabled', true);
            
                $.ajax({
                    url: "{{ route('hawb.draft.generate', $id) }}",
                    method: "POST",
                    data: $(this).serialize() + '&download=pdf',
                    success: function(response){
                        $('#draft-container').removeClass('d-none').addClass('d-block');
                        $('#draftResult').html(response.html);
                        
                        $('#pdfHTML').removeClass('d-none').addClass('d-block');
                        
                        $('#showReportBtn').text('SHOW REPORT').prop('disabled', false);
                        
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
                btn.text('Downloading...').prop('disabled', true);
            
                showPdfLoader('Downloading PDF');
            
                try {
                    const source = document.getElementById("draftResult");
            
                    const printContent = document.createElement("div");
                    printContent.style.width = "210mm";
                    printContent.style.minHeight = "297mm";
                    printContent.style.padding = "2mm";
                    printContent.style.background = "#ffffff";
                    printContent.innerHTML = source.innerHTML;
            
                    const opt = {
                        margin: 0,
                        filename: 'Air-Export-Draft-' + Date.now() + '.pdf',
                        image: { type: 'jpeg', quality: 6 },
                        html2canvas: {
                            scale: 10,
                            dpi: 400,
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
                        url: "{{ route('air.export.hawb.check.download') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            job_no: "{{ $airExportDraftData->job_no }}",
                            copy_type: $('input[name="hbl_type"]:checked').val()
                        }
                    });
                    
                    if (!permission.status) {
                        hidePdfLoader();
                    
                        Swal.fire({
                            icon: "warning",
                            title: "Download Limit",
                            text: permission.message
                        });
                    
                        btn.text("Download PDF").prop("disabled", false);
                        return;
                    }
                    
                    await html2pdf().set(opt).from(printContent).save();
                    
                    await $.ajax({
                        url: "{{ route('air.export.hawb.confirm.download') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            job_no: "{{ $airExportDraftData->job_no }}",
                            copy_type: $('input[name="hbl_type"]:checked').val()
                        }
                    });
            
                    hidePdfLoader();
            
                    Swal.fire({
                        icon: 'success',
                        title: 'Downloaded',
                        text: 'PDF downloaded successfully'
                    });
            
                } catch (e) {
                    hidePdfLoader();
                    Swal.fire('Error', 'PDF generation failed', 'error');
                }
            
                btn.text('Download PDF').prop('disabled', false);
            });

            
            $(document).on("click", "#downloadAllPdf", async function () {

                const btn = $(this);
            
                if (!$('#issue_date').val() || !$('#freight_payable').val().trim()) {
                    Swal.fire('Required', 'Please fill Issue Date & Freight Payable', 'warning');
                    return;
                }
                
                btn.text('Generating...').prop('disabled', true);
                showPdfLoader('Generating All PDFs');
            
                try {
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
                    
                                url: "{{ route('air.export.hawb.check.download') }}",
                    
                                type: "POST",
                    
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    job_no: "{{ $airExportDraftData->job_no }}",
                                    copy_type: type
                                }
                    
                            });
                    
                        } catch (xhr) {
                    
                            let message = "Download limit reached.";
                    
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                    
                            hidePdfLoader();
                    
                            Swal.fire({
                                icon: "warning",
                                title: "Download Blocked",
                                text: message
                            });
                    
                            btn.text("Download All PDFs")
                               .prop("disabled", false);
                    
                            return;
                        }
                    
                    }
            
                    const issueDate = $('#issue_date').val();
                    const freightPayable = $('#freight_payable').val();
                    const url = "{{ route('hawb.draft.generate', $id) }}";
            
                    let container = document.createElement("div");
            
                    for (let type of hblTypes) {

                        let response = await $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                hbl_type: type,
                                issue_date: issueDate,
                                freight_payable: freightPayable
                            }
                        });
                    
                        let page = document.createElement("div");
                    
                        page.style.width = "210mm";
                        page.style.padding = "0";
                        page.style.margin = "0";
                        page.style.breakAfter = "page";
                    
                        if (type === hblTypes[hblTypes.length - 1]) {
                            page.style.breakAfter = "auto";
                        }
                    
                        page.innerHTML = response.html;
                    
                        container.appendChild(page);
                    }
                    
                    await html2pdf().set({

                        margin: [0, 0, 0, 0],
                    
                        filename: "ALL_HBL_COPIES_" + Date.now() + ".pdf",
                    
                        image: {
                            type: 'jpeg',
                            quality: 1
                        },
                    
                        html2canvas: {
                            scale: 3.5,
                            dpi: 900,
                            useCORS: true,
                            scrollY: 0,
                            logging: false
                        },
                    
                        jsPDF: {
                            unit: "mm",
                            format: "a4",
                            orientation: "portrait"
                        },
                    
                        pagebreak: {
                            mode: ['avoid-all', 'css', 'legacy']
                        }
                    
                    }).from(container).save();
                    
                    for (const type of hblTypes) {

                        await $.ajax({
                    
                            url: "{{ route('air.export.hawb.confirm.download') }}",
                    
                            type: "POST",
                    
                            data: {
                    
                                _token: "{{ csrf_token() }}",
                    
                                job_no: "{{ $airExportDraftData->job_no }}",
                    
                                copy_type: type
                    
                            }
                    
                        });
                    
                    }
            
                    hidePdfLoader();
            
                    Swal.fire({
                        icon: 'success',
                        title: 'Done',
                        text: 'All HBL PDFs downloaded successfully'
                    });
            
                } catch (err) {
                    hidePdfLoader();
                    Swal.fire('Error', 'Failed to generate PDFs', 'error');
                }
            
                btn.text('Download All PDFs').prop('disabled', false);
            });

            $('#downloadWord').on('click', function(){
                var content = document.getElementById("draftResult").innerHTML;
            
                // Add inline CSS (Word ignores external CSS)
                var styles = `
                    <style>
                        body { font-family: Arial, sans-serif; font-size: 12px; }
                        table { border-collapse: collapse; width: 100%; }
                        table, th, td { border: 1px solid black; padding: 5px; }
                        th { background: #f0f0f0; }
                        .text-center { text-align: center; }
                    </style>
                `;
            
                var html = '<!DOCTYPE html><html><head><meta charset="utf-8">' + styles + '</head><body>' 
                            + content + '</body></html>';
            
                // Convert HTML → DOCX
                var converted = htmlDocx.asBlob(html);
            
                // Save file
                saveAs(converted, 'Draft_Report_' + new Date().getTime() + '.docx');
            });

            
        });
        
          // page-break-after: always;
        // page-break-inside: avoid;
        // width: 210mm;
        // min-height: 297mm;
    </script>

@endpush
@extends('admin-main.layouts.default')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="text-center text-primary fw-bold mb-4">
                MULTIMODAL TRANSPORT DOCUMENT :
            </h4>

            <form id="hblForm" action="{{ route('import.sea.way.bill', $id) }}" method="GET" target="_blank">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.1/html-docx.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        // $(document).ready(function(){
            
        //     $('#hblForm').on('submit', function(e){
        //         e.preventDefault();

        //         $.ajax({
        //             url: "{{ route('import.draft.generate', $id) }}",
        //             method: "POST",
        //             data: $(this).serialize() + '&download=pdf',
        //             success: function(response){
        //                 $('#draft-container').removeClass('d-none').addClass('d-block');
        //                 $('#draftResult').html(response.html);
                        
        //             },
        //             error: function(xhr){
        //                 console.error(xhr.responseText);
        //                 alert("Something went wrong.");
        //             }
        //         });
        //     });
            
        //     $('input[name="hbl_type"]').change(function(){
        //         $('input[name="hbl_type"]').each(function(){
        //             $('label[for="'+$(this).attr('id')+'"]').removeClass('text-primary');
        //         });
        //         $('label[for="'+$(this).attr('id')+'"]').addClass('text-primary');
        //     });
            
            // $(document).on("click", "#downloadPdf", function () {
            //     var element = document.getElementById("draftResult");
            
            //     var opt = {
            //         margin: 10,
            //         filename: 'SeaExportDraft.pdf',
            //         image: { type: 'jpeg', quality:1 },
            //         html2canvas: { scale: 2, useCORS: true, scrollY: 0   },
            //         jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            //     };
            
            //     html2pdf().set(opt).from(element).save();
            // });
            
            
            // //Download Word File (client-side only)
            // $('#downloadWord').on('click', function(){
            //     // Get the draft HTML
            //     var content = document.getElementById("draftResult").innerHTML;
            
            //     // Add Word-compatible structure
            //     var header = `
            //         <html xmlns:o='urn:schemas-microsoft-com:office:office' 
            //               xmlns:w='urn:schemas-microsoft-com:office:word' 
            //               xmlns='http://www.w3.org/TR/REC-html40'>
            //         <head><meta charset="utf-8"><title>Document</title></head><body>`;
            //     var footer = "</body></html>";
            //     var html = header + content + footer;
            
            //     // Create a blob with Word MIME type
            //     var blob = new Blob(['\ufeff', html], {
            //         type: 'application/msword'
            //     });
            
            //     // File name
            //     var filename = 'Draft_Report_' + new Date().getTime() + '.doc';
            
            //     // Create temporary download link
            //     var link = document.createElement('a');
            //     link.href = URL.createObjectURL(blob);
            //     link.download = filename;
            
            //     // Trigger download
            //     document.body.appendChild(link);
            //     link.click();
            
            //     // Clean up
            //     document.body.removeChild(link);
            // });
            
            
            // ✅ PDF DOWNLOAD (Clean A4 Layout)
        //     $(document).on("click", "#downloadPdf", function () {
        //         const element = document.getElementById("draftResult");
            
        //         const printContent = document.createElement("div");
        //         printContent.style.padding = "5mm";
        //         printContent.style.background = "#fff";
        //         printContent.style.width = "210mm";   // A4 width
        //         printContent.innerHTML = element.innerHTML;
            
        //         const opt = {
        //             margin: 0,
        //             filename: 'Bill_of_Lading_' + Date.now() + '.pdf',
            
        //             image: {
        //                 type: 'png',      // 🔥 VERY IMPORTANT
        //                 quality: 1
        //             },
            
        //             html2canvas: {
        //                 scale: 3,         // 🔥 KEY FIX (2 or 3)
        //                 useCORS: true,
        //                 letterRendering: true,
        //                 scrollY: 0
        //             },
            
        //             jsPDF: {
        //                 unit: 'mm',
        //                 format: 'a4',
        //                 orientation: 'portrait'
        //             }
        //         };
            
        //         html2pdf().set(opt).from(printContent).save();
        //     });

            
            
        //     // ✅ WORD DOWNLOAD (Proper Document Page Setup)
        //     $('#downloadWord').on('click', function(){
        //         var content = document.getElementById("draftResult").innerHTML;
            
        //         // Add Word page styling
        //         var header = `
        //             <html xmlns:o='urn:schemas-microsoft-com:office:office' 
        //                   xmlns:w='urn:schemas-microsoft-com:office:word' 
        //                   xmlns='http://www.w3.org/TR/REC-html40'>
        //             <head><meta charset="utf-8">
        //             <title>Bill of Lading</title>
        //             <style>
        //                 @page {
        //                     size: A4;
        //                     margin: 10mm;
        //                 }
        //                 body {
        //                     font-family: Arial, sans-serif;
        //                     font-size: 11px;
        //                     color: #000;
        //                     background: #fff;
        //                     position:relative;
        //                 }
        //                 table { width: 100%; border-collapse: collapse; }
        //                 td, th { border: 1px solid #000; padding: 6px; vertical-align: top; }
        //                 h3, h4 { margin: 0; }
        //             </style>
        //             </head><body>`;
            
        //         var footer = "</body></html>";
        //         var html = header + content + footer;
            
        //         var blob = new Blob(['\ufeff', html], {
        //             type: 'application/msword'
        //         });
            
        //         var filename = 'Bill_of_Lading_' + new Date().getTime() + '.doc';
            
        //         var link = document.createElement('a');
        //         link.href = URL.createObjectURL(blob);
        //         link.download = filename;
        //         document.body.appendChild(link);
        //         link.click();
        //         document.body.removeChild(link);
        //     });


        // });
    </script>

@endpush
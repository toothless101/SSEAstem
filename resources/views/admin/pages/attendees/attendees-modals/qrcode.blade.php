<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>        
            <div class="modal-body">
                <form action="" method="">
                    <div class=" d-flex justify-content-center">
                        <img src="" alt="QR Code" id="qrCodeImg" width="200" height="200">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="printQR" class="btn btn-submit">Print</button>
                    </div>
                </form>            
            </div>       
        </div>   
    </div>
</div>

<script>
    //Qr Code
    $(document).ready(function(){
        $('.open-qr-modal').click(function(event){
            event.preventDefault();

            //get rollnumber from the clicked qr icon
            var rollno = $(this).data('rollno');
            if (!rollno) {
            console.error("Roll number is missing!");
            return;
        }
            //generate qr code 
            var qrUrl = "{{ url('/generate-qrcode') }}/" + rollno;

            // console.log("QR Code URL:", qrUrl); // Debugging - check if URL is correct
            //set qr code image inside the modal
            $('#qrCodeImg').attr('src', qrUrl);

            //show the modal
            $('#qrCodeModal').modal('show');
        });

         // Print QR Code
    $('#printQR').click(function () {
        event.preventDefault();
        var img = document.getElementById('qrCodeImg');

        // Ensure QR code is fully loaded before printing
        if (!img.complete || img.naturalWidth === 0) {
            alert("QR Code is still loading. Please wait.");
            return;
        }

        // Open a new print window
        var printWindow = window.open('', '', 'width=600, height=600');

        // HTML content for print preview
        printWindow.document.write(`
            <html>
            <head>
                <title>School Event QR Code</title>
                <style>
                    body { text-align: center; font-family: Arial, sans-serif; }
                    img { width: 300px; height: 300px; margin: 20px auto; display: block; }
                </style>
            </head>
            <body>
                <h2>SSEA QR Code</h2>
                <img id="printQrImage" src="${img.src}" alt="QR Code">
                <script>
                    // Wait for image to fully load before triggering print
                    document.getElementById('printQrImage').onload = function() {
                        window.print();
                        window.onafterprint = function() { window.close(); };
                    };
                <\/script>
            </body>
            </html>
        `);

        printWindow.document.close();
    });

    });
</script>
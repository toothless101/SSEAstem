<!-- Scanner Modal -->
<div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Success alert -->
            <div id="success-alert" class="alert alert-success d-none" role="alert"></div>
            <!-- Error Alert -->
            <div id="error-alert" class="alert alert-danger d-none" role="alert"></div>
            
            <!-- Success and Error Messages -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <div class="modal-header">
                <h5 class="modal-title">Scan QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="stopScanner()"></button>
            </div>
            
            <div class="modal-body text-center">
                <div class="row">
                    <!-- QR Scanner Area -->
                    <div class="col-md-6 d-flex align-items-center justify-content-center flex-column">
                        <div id="reader" class="w-100" style="height: 100%;"></div>
                        <p class="mt-2">Scan QR Code Here</p>
                    </div>

                    <!-- Display Present Attendee Information -->
                    <div class="col-md-6">
                        <h6>Present Attendees</h6>
                        <div class="mt-2 align-content-center">
                            <img id="profile-img" src="" class="rounded-circle mb-3" alt="Profile">
                        </div>
                        <div class="d-flex flex-column align-items-start">    
                            <div class="d-flex flex-column justify-start">
                                <p><strong>Roll No.:</strong> <span id="rollNo"></span></p>
                                <p><strong>Name:</strong> <span id="name"></span></p>
                                <p><strong>Time:</strong> <span id="time"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal" onclick="">Next Scan</button>
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal" onclick="stopScanner()">Done</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Html5-qrcode Library for QR Scanning -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    let scanner = null;
    let isScanning = false;

    // Function to start the QR scanner
    function startScanner() {
        if (isScanning) return; // Prevent multiple instances
        isScanning = true;

        scanner = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                let cameraId = devices[0].id; // Use the first available camera
                scanner.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: function(viewfinderWidth, viewfinderHeight) {
                            let minSize = Math.min(viewfinderWidth, viewfinderHeight) * 0.6; // 60% of the container
                            return { width: minSize, height: minSize };
                        }
                    },
                    (decodedText) => processScannedData(decodedText), // Process scanned QR data
                    (errorMessage) => console.warn(`Scan Error: ${errorMessage}`) // Log errors
                );
            } else {
                console.error("No camera devices found");
            }
        }).catch(err => console.error("Camera access error", err));
    }

    // Function to stop the scanner
    function stopScanner() {
        if (scanner) {
            scanner.stop().then(() => {
                isScanning = false;
                console.log("Scanner stopped");
            }).catch(err => console.warn("Scanner Stop Error:", err));
        }
    }

    // Function to show success alert
    function showSuccessAlert(message) {
        let alertBox = document.getElementById("success-alert");
        alertBox.innerText = message;
        alertBox.classList.remove("d-none");  // Show alert
        setTimeout(() => alertBox.classList.add("d-none"), 3000); // Hide after 3s
    }

    // Function to show error alert
    function showErrorAlert(message) {
        let alertBox = document.getElementById("error-alert");
        alertBox.innerText = message;
        alertBox.classList.remove("d-none");  // Show alert
        setTimeout(() => alertBox.classList.add("d-none"), 3000); // Hide after 3s
    }

    // Function to process scanned QR code data
    function processScannedData(qrData) {
        console.log("Scanned QR Code Data:", qrData);
        stopScanner(); // Stop scanning after a successful scan

        // Extract roll number
        let rollNo = qrData.split("\n")[0].replace("Roll No: ", "").trim();

        // Send the scanned roll number to the server for attendance recording
        fetch('/admin/attendance/store', {  
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ rollno: rollNo })  // Send roll number
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI with attendee details
                document.getElementById("rollNo").innerText = data.attendee.rollno;
                document.getElementById("name").innerText = data.attendee.firstname + " " + 
                    (data.attendee.middlename ? data.attendee.middlename + " " : "") + 
                    data.attendee.lastname;           
                document.getElementById("time").innerText = data.time;
                document.getElementById("profile-img").src = data.attendee.img || "https://via.placeholder.com/100";

                showSuccessAlert("Attendance Recorded Successfully");
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Fetch Error:', error));
    }

    // Automatically start scanner when modal is opened
    document.getElementById("qrScannerModal").addEventListener("shown.bs.modal", startScanner);

    // Stop scanner when modal is closed
    document.getElementById("qrScannerModal").addEventListener("hidden.bs.modal", stopScanner);
</script>

<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\PngEncoder;     //import Png Encoder
class QRCodeController extends Controller
{

    public function generateQrCode($rollno)
    {
        // Find the attendee based on their roll number
        $attendee = Attendees::where('rollno', $rollno)->first();

        if (!$attendee) {
            abort(404, 'Student not Found!');
        }

        // Prepare the data to encode in the QR code
        $qrData = "Roll No: {$attendee->rollno}\nName: {$attendee->firstname} {$attendee->middlename} {$attendee->lastname}";

        // QR Code Settings
        $options = new QROptions([
            'eccLevel' => EccLevel::H, // High error correction level
            'imageBase64' => false,                   // Disables Base64 encoding
            'scale' => 10, // Size of QR code
        ]);

        // Generate PNG QR Code
        $qrcodePng = (new QRCode($options))->render($qrData);

        // Convert the raw binary string to an image response
        return response($qrcodePng)->header('Content-Type', 'image/svg+xml');
        // return response ($qrcodeSvg);
    }
    
}

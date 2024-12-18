<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PragmaRX\Google2FA\Google2FA;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class TwoFactorController extends Controller
{
    public function showSetupForm()
    {
        $google2fa = new Google2FA();

        // Generate a secret key for the user
        $secret = $google2fa->generateSecretKey();

        $user = Auth::user();
        $user->google2fa_secret = $secret;
        $user->save();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'Form Data Solution',
            $user->email,
            $secret
        );
        
          // Generate QR code using Endroid QR Code
          $qrCode = new QrCode($qrCodeUrl);
          $qrCode->setSize(300);
          $qrCode->setMargin(10);
  
          // Use PngWriter to generate PNG image data
          $pngWriter = new PngWriter();
          $qrCodeImageResult = $pngWriter->write($qrCode);
  
          // Get the image binary data from the result
          $qrCodeImageData = $qrCodeImageResult->getString();
  
          // Convert QR code image data to base64
          $base64QRCode = base64_encode($qrCodeImageData);
  
          return response()->json([
              'qrCodeUrl' => 'data:image/png;base64,' . $base64QRCode
          ]);
    }
        public function EnableGoogleAuth(Request $request){
            $otpCode = $request->input('otpcode');
            $google2fa = new Google2FA();
            $secret = Auth::user()->google2fa_secret;
            
            // Verify OTP code
            $valid = $google2fa->verifyKey($secret, $otpCode);
            
            if ($valid) {
                // OTP code is valid, enable 2FA for the user
                Auth::user()->two_factor_enabled = 1;
                Auth::user()->save();
                
                return redirect()->back()->with('success', 'Two-factor authentication enabled successfully.');
            } else {
                // OTP code is invalid
                return redirect()->back()->with('error', 'Invalid OTP code. Please try again.');
            }
    }
}

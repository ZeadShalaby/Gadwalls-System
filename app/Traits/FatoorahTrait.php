<?php

namespace App\Traits;


use App\Traits\QrCodeTrait;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;

trait FatoorahTrait
{


    // ?todo create qrcode
    private function createQrCode($data)
    {
        //? create QR code
        $qrCode = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        return $qrCode;
    }



    // ?todo add logo to image 
    private function createLogo()
    {
        //? create logo
        $logoPath = public_path('images/img/icon.png');
        if (!file_exists($logoPath)) {
            throw new \Exception("Logo image not found at: " . $logoPath);
        }
        $logo = Logo::create($logoPath)
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true);

        return $logo;
    }


    // ?todo create pdf & return dompdf
    private function CreateDemo($data)
    {
        $writer = new PngWriter();
        $qrCode = $this->createQrCode($data);
        $logo = $this->createLogo();
        $result = $writer->write($qrCode, $logo);

        //?todo Convert the QR code to base64
        $qrCodeBase64 = 'data:' . $result->getMimeType() . ';base64,' . base64_encode($result->getString());
        return $qrCodeBase64;

    }

    // ! generate QrCode and send it via gmail
    public function generateQrCode($data)
    {
        //?todo Generate the QR code
        $dompdf = $this->CreateDemo($data);
        return $dompdf;
    }




    // //?todo create successful notification
    // public function successNotification($msg)
    // {
    //     return Notification::send(auth()->user(), new SuccessNotification($msg));
    // }


}






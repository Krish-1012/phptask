<?php
declare(strict_types=1);
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
require_once('vendor/autoload.php');

function returnQr($string){
  $options = new QROptions(
  [
    'eccLevel' => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    'version' => 5,
  ]
);
  return (new QRCode($options))->render($string);
}
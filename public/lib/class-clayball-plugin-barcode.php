<?php
//
//namespace Clayball\Pub\Barcode;
//
//use BarcodeBakery\Common\BCGColor;
//use BarcodeBakery\Common\BCGDrawing;
//use BarcodeBakery\Barcode\BCGean13;
//class ClayballCreateBarcode
//{
//    public $colorFront;
//    public $colorBack;
//    public $code;
//
//    public function __construct()
//    {
//        $this->colorFront = new BCGColor(0, 0, 0);
//        $this->colorBack  = new BCGColor(255, 255, 255);
//        $this->code       = new BCGean13();
//        $this->code->setScale(2);
//        $this->code->setThickness(30);
//        $this->code->setForegroundColor($this->colorFront);
//        $this->code->setBackgroundColor($this->colorBack);
//
//    }
//
//    public function barcode($code = null)
//    {
//        if ($code == null) return;
//        $this->code->parse($code);
//
//        $drawing = new BCGDrawing(false, $this->colorBack);
//        $drawing->setBarcode($this->code);
//        $img = base64_encode($drawing->draw());
//        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
//        return $img;
//    }
//}

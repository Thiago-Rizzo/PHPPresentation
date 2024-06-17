<?php

namespace PhpOffice\PhpPresentation\Style;

use PhpOffice\Common\Drawing as CommonDrawing;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use DOMElement;

class OuterShdw
{
    public ?int $blurRad = null;
    public ?int $dist = null;
    public ?int $dir = null;
    public ?int $rotWithShape = null;
    public string $algn = '';

    public ?Color $color = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:outerShdw', $node);
        if (!$dom) {
            return null;
        }

        $outerShdw = new self();

        if ($dom->hasAttribute('blurRad')) {
            $outerShdw->blurRad = CommonDrawing::emuToPixels((int)$dom->getAttribute('blurRad'));
        }
        if ($dom->hasAttribute('dist')) {
            $outerShdw->dist = CommonDrawing::emuToPixels((int)$dom->getAttribute('dist'));
        }
        if ($dom->hasAttribute('dir')) {
            $outerShdw->dir = (int)CommonDrawing::angleToDegrees((int)$dom->getAttribute('dir'));
        }

        if ($dom->hasAttribute('rotWithShape')) {
            $outerShdw->rotWithShape = (int)$dom->getAttribute('rotWithShape');
        }

        $outerShdw->algn = $dom->getAttribute('algn');

        $outerShdw->color = SchemeColor::load($xmlReader, $dom);

        return $outerShdw;
    }


    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:outerShdw');

        $this->blurRad !== null && $writer->writeAttribute('blurRad', CommonDrawing::pixelsToEmu($this->blurRad));
        $this->dist !== null && $writer->writeAttribute('dist', CommonDrawing::pixelsToEmu($this->dist));
        $this->dir !== null && $writer->writeAttribute('dir', CommonDrawing::degreesToAngle($this->dir));
        $this->algn !== '' && $writer->writeAttribute('algn', $this->algn);
        $this->rotWithShape !== null && $writer->writeAttribute('rotWithShape', $this->rotWithShape);

        $this->color && $this->color->write($writer);

        $writer->endElement();
    }
}

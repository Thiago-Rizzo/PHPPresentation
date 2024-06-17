<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\Drawing as CommonDrawing;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Xfrm
{
    public string $flipH = '';
    public string $flipV = '';
    public ?int $rotation = null;

    public ?Off $off = null;
    public ?Ext $ext = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:xfrm', $node);
        if (!$element) {
            return null;
        }

        $xfrm = new self();

        $xfrm->flipH = $element->getAttribute('flipH');
        $xfrm->flipV = $element->getAttribute('flipV');
        $xfrm->rotation = (int)CommonDrawing::angleToDegrees((int)$element->getAttribute('rot'));

        $xfrm->off = Off::load($xmlReader, $element);
        $xfrm->ext = Ext::load($xmlReader, $element);

        return $xfrm;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:xfrm');

        $this->rotation && $writer->writeAttribute('rot', CommonDrawing::degreesToAngle($this->rotation));
        $this->flipH !== '' && $writer->writeAttribute('flipH', $this->flipH);
        $this->flipV !== '' && $writer->writeAttribute('flipV', $this->flipV);

        $this->off && $this->off->write($writer);
        $this->ext && $this->ext->write($writer);

        $writer->endElement();
    }
}

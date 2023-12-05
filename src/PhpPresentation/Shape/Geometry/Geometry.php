<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Geometry
{
    public string $tag;

    public string $prst = '';

    public ?AvLst $avLst = null;
    public ?GdLst $gdLst = null;
    public ?AhLst $ahLst = null;
    public ?CxnLst $cxnLst = null;
    public ?Rect $rect = null;
    public ?PathLst $pathLst = null;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:custGeom', $node);
        if ($element) {
            $geometry = new self('a:custGeom');
        } else {

            $element = $xmlReader->getElement('a:prstGeom', $node);
            if ($element) {
                $geometry = new self('a:prstGeom');
            }
        }

        if (!$element) {
            return null;
        }

        $geometry->prst = $element->getAttribute('prst');

        $geometry->avLst = AvLst::load($xmlReader, $element);
        $geometry->gdLst = GdLst::load($xmlReader, $element);
        $geometry->ahLst = AhLst::load($xmlReader, $element);
        $geometry->cxnLst = CxnLst::load($xmlReader, $element);
        $geometry->rect = Rect::load($xmlReader, $element);
        $geometry->pathLst = PathLst::load($xmlReader, $element);

        return $geometry;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement($this->tag);

        $this->prst !== '' && $writer->writeAttribute('prst', $this->prst);

        $this->avLst && $this->avLst->write($writer);
        $this->gdLst && $this->gdLst->write($writer);
        $this->ahLst && $this->ahLst->write($writer);
        $this->cxnLst && $this->cxnLst->write($writer);
        $this->rect && $this->rect->write($writer);
        $this->pathLst && $this->pathLst->write($writer);

        $writer->endElement();
    }
}

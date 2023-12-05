<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Shape\Geometry\Geometry;
use PhpOffice\PhpPresentation\Style\Fill;

class SpPr
{
    public ?Xfrm $xfrm = null;

    public ?Geometry $geometry = null;

    public ?Fill $fill = null;

    public ?Ln $ln = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:spPr', $node);
        if (!$element) {
            return null;
        }

        $spPr = new self();

        $spPr->xfrm = Xfrm::load($xmlReader, $element);
        $spPr->geometry = Geometry::load($xmlReader, $element);
        $spPr->fill = Fill::load($xmlReader, $element);
        $spPr->ln = Ln::load($xmlReader, $element);

        return $spPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:spPr');

        $this->xfrm && $this->xfrm->write($writer);
        $this->geometry && $this->geometry->write($writer);
        $this->fill && $this->fill->write($writer);
        $this->ln && $this->ln->write($writer);

        $writer->endElement();
    }
}

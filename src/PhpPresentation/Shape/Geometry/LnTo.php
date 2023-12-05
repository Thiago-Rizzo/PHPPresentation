<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class LnTo
{
    public ?Pt $pt = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:lnTo', $node);
        if (!$dom) {
            return null;
        }

        $lnTo = new self();
        $lnTo->pt = Pt::load($xmlReader, $dom);

        return $lnTo;
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node): self
    {
        $lnTo = new self();
        $lnTo->pt = Pt::load($xmlReader, $node);

        return $lnTo;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:lnTo');
        $this->pt && $this->pt->write($writer);
        $writer->endElement();
    }
}
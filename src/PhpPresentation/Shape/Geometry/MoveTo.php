<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class MoveTo
{
    public ?Pt $pt = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:moveTo', $node);
        if (!$dom) {
            return null;
        }

        $path = new self();
        $path->pt = Pt::load($xmlReader, $dom);

        return $path;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:moveTo');
        $this->pt && $this->pt->write($writer);
        $writer->endElement();
    }
}
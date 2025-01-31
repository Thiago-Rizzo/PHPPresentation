<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Close
{
    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:close', $node);
        if (!$dom) {
            return null;
        }

        return new self();
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:close');
        $writer->endElement();
    }
}
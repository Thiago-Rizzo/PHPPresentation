<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class AvLst
{
    public ?Gd $gd = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:avLst', $node);
        if (!$dom) {
            return null;
        }

        $avLst = new self();

        $avLst->gd = Gd::load($xmlReader, $dom);

        return $avLst;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:avLst');

        $this->gd !== null && $this->gd->write($writer);
        
        $writer->endElement();
    }
}

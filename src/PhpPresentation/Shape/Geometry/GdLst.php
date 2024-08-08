<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class GdLst
{
    /** @var Gd[] $gd */
    public array $gd = [];

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:gdLst', $node);
        if (!$dom) {
            return null;
        }

        $gdLst = new self();

        foreach ($dom->childNodes as $oElement) {
            if ($oElement instanceof DOMElement && $oElement->nodeName === 'a:gd') {
                $gdLst->gd[] = Gd::loadByElement($xmlReader, $oElement);
            }
        }

        return $gdLst;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gdLst');

        foreach ($this->gd as $gd) {
            $gd->write($writer);
        }

        $writer->endElement();
    }
}

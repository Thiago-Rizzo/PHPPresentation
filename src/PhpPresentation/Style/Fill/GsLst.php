<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class GsLst
{
    /** @var array<Gs>|Gs[] $gses */
    public array $gses = [];

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:gsLst', $node);
        if (!$dom) {
            return null;
        }

        $gsLst = new self();

        foreach ($dom->childNodes as $element) {
            if (($element instanceof DOMElement) && $element->nodeName === 'a:gs') {
                $gsLst->gses[] = Gs::loadByElement($xmlReader, $element);
            }
        }

        return $gsLst;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gsLst');

        foreach ($this->gses as $gs) {
            $gs->write($writer);
        }

        $writer->endElement();
    }
}

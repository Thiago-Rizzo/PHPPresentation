<?php

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class CubicBezTo extends Sequential
{
    /** @var array<Pt> $pt */
    public array $pts = [];

    public static function load(XMLReader $xmlReader, DOMElement $node, int $sequence = 0): ?self
    {
        $dom = $xmlReader->getElement('a:cubicBezTo', $node);
        if (!$dom) {
            return null;
        }

        return self::loadByElement($xmlReader, $dom, $sequence);
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node, int $sequence = 0): self
    {
        $cubicBezTo = new self();

        $cubicBezTo->sequence = $sequence;

        $ptSsequence = 1;
        foreach ($node->childNodes as $oElement) {
            if ($oElement instanceof DOMElement) {
                if ($oElement->nodeName === 'a:pt') {
                    $cubicBezTo->pts[] = Pt::loadByElement($xmlReader, $oElement, $ptSsequence++);
                }
            }
        }

        return $cubicBezTo;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:cubicBezTo');

        if (!empty($this->pts)) {
            usort($this->pts, fn($a, $b) => $a->sequence <=> $b->sequence);
            foreach ($this->pts as $pt) {
                $pt->write($writer);
            }
        }

        $writer->endElement();
    }
}

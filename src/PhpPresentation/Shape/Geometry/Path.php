<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Path
{
    public string $w = '';
    public string $h = '';
    public string $extrusionOk = '';
    public ?MoveTo $moveTo = null;

    /** @var LnTo[]|array $lnTos */
    public array $lnTos = [];

    /** @var CubicBezTo[]|array $cubicBezTos */
    public array $cubicBezTos = [];

    public ?Close $close = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:path', $node);
        if (!$dom) {
            return null;
        }

        $path = new self();
        $path->w = $dom->getAttribute('w');
        $path->h = $dom->getAttribute('h');
        $path->extrusionOk = $dom->getAttribute('extrusionOk');

        $path->moveTo = MoveTo::load($xmlReader, $dom);
        $path->close = Close::load($xmlReader, $dom);

        $sequence = 1;
        foreach ($dom->childNodes as $oElement) {
            if ($oElement instanceof DOMElement) {
                if ($oElement->nodeName === 'a:lnTo') {
                    $path->lnTos[] = LnTo::loadByElement($xmlReader, $oElement, $sequence++);
                } elseif ($oElement->nodeName === 'a:cubicBezTo') {
                    $path->cubicBezTos[] = CubicBezTo::loadByElement($xmlReader, $oElement, $sequence++);
                }
            }
        }

        return $path;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:path');
        $this->w !== '' && $writer->writeAttribute('w', $this->w);
        $this->h !== '' && $writer->writeAttribute('h', $this->h);
        $this->extrusionOk !== '' && $writer->writeAttribute('extrusionOk', $this->extrusionOk);

        $this->moveTo && $this->moveTo->write($writer);

        $sequential = array_merge($this->lnTos, $this->cubicBezTos);

        if (!empty($sequential)) {
            usort($sequential, fn(Sequential $a, Sequential $b) => $a->sequence <=> $b->sequence);
            foreach ($sequential as $el) {
                $el->write($writer);
            }
        }

        $this->close && $this->close->write($writer);

        $writer->endElement();
    }
}

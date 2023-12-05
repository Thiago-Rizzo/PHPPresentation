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

    /** @var array<int, LnTo> */
    public array $lnTo = [];

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

        $arrayElements = $xmlReader->getElements('a:lnTo', $dom);
        foreach ($arrayElements as $oElement) {
            if ($oElement instanceof DOMElement) {
                $path->lnTo[] = LnTo::loadByElement($xmlReader, $oElement);
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

        foreach ($this->lnTo as $lnTo) {
            $lnTo->write($writer);
        }

        $this->close && $this->close->write($writer);

        $writer->endElement();
    }
}

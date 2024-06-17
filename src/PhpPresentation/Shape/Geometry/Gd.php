<?php

namespace PhpOffice\PhpPresentation\Shape\Geometry;


use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Gd
{
    public string $name = '';
    public string $fmla = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:gd', $node);
        if (!$dom) {
            return null;
        }

        $gd = new self();

        $gd->name = $dom->getAttribute('name');
        $gd->fmla = $dom->getAttribute('fmla');

        return $gd;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gd');

        $this->name != '' && $writer->writeAttribute('name', $this->name);
        $this->fmla != '' && $writer->writeAttribute('fmla', $this->fmla);

        $writer->endElement();
    }
}

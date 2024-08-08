<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Sym
{
    public string $typeface = '';
    public string $panose = '';
    public string $charset = '';
    public string $pitchFamily = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:sym', $node);
        if (!$dom) {
            return null;
        }

        $sym = new self();

        $sym->typeface = $dom->getAttribute('typeface');
        $sym->panose = $dom->getAttribute('panose');
        $sym->charset = $dom->getAttribute('charset');
        $sym->pitchFamily = $dom->getAttribute('pitchFamily');

        return $sym;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:sym');

        $this->typeface !== '' && $writer->writeAttribute('typeface', $this->typeface);
        $this->panose !== '' && $writer->writeAttribute('panose', $this->panose);
        $this->pitchFamily !== '' && $writer->writeAttribute('pitchFamily', $this->pitchFamily);
        $this->charset !== '' && $writer->writeAttribute('charset', $this->charset);

        $writer->endElement();
    }
}

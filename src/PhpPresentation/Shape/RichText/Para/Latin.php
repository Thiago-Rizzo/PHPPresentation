<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Latin
{
    public string $typeface = '';
    public string $panose = '';
    public string $charset = '';
    public string $pitchFamily = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:latin', $node);
        if (!$dom) {
            return null;
        }

        $latin = new self();

        $latin->typeface = $dom->getAttribute('typeface');
        $latin->panose = $dom->getAttribute('panose');
        $latin->charset = $dom->getAttribute('charset');
        $latin->pitchFamily = $dom->getAttribute('pitchFamily');

        return $latin;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:latin');

        $this->typeface !== '' && $writer->writeAttribute('typeface', $this->typeface);
        $this->panose !== '' && $writer->writeAttribute('panose', $this->panose);
        $this->pitchFamily !== '' && $writer->writeAttribute('pitchFamily', $this->pitchFamily);
        $this->charset !== '' && $writer->writeAttribute('charset', $this->charset);

        $writer->endElement();
    }
}

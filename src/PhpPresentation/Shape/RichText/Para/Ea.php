<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use DOMElement;

class Ea
{
    public string $typeface = '';
    public string $panose = '';
    public string $charset = '';
    public string $pitchFamily = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:ea', $node);
        if (!$dom) {
            return null;
        }

        $ea = new self();

        $ea->typeface = $dom->getAttribute('typeface');
        $ea->panose = $dom->getAttribute('panose');
        $ea->charset = $dom->getAttribute('charset');
        $ea->pitchFamily = $dom->getAttribute('pitchFamily');

        return $ea;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:ea');

        $this->typeface !== '' && $writer->writeAttribute('typeface', $this->typeface);
        $this->panose !== '' && $writer->writeAttribute('panose', $this->panose);
        $this->pitchFamily !== '' && $writer->writeAttribute('pitchFamily', $this->pitchFamily);
        $this->charset !== '' && $writer->writeAttribute('charset', $this->charset);

        $writer->endElement();
    }
}

<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Cs
{
    public string $typeface = '';
    public string $panose = '';
    public string $charset = '';
    public string $pitchFamily = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:cs', $node);
        if (!$dom) {
            return null;
        }

        $cs = new self();

        $cs->typeface = $dom->getAttribute('typeface');
        $cs->panose = $dom->getAttribute('panose');
        $cs->charset = $dom->getAttribute('charset');
        $cs->pitchFamily = $dom->getAttribute('pitchFamily');

        return $cs;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:cs');

        $this->typeface !== '' && $writer->writeAttribute('typeface', $this->typeface);
        $this->panose !== '' && $writer->writeAttribute('panose', $this->panose);
        $this->pitchFamily !== '' && $writer->writeAttribute('pitchFamily', $this->pitchFamily);
        $this->charset !== '' && $writer->writeAttribute('charset', $this->charset);

        $writer->endElement();
    }
}

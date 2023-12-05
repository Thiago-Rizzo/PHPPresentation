<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Stretch
{
    public ?FillRect $fillRect = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:stretch', $node);
        if (!$element) {
            return null;
        }

        $stretch = new self();

        $stretch->fillRect = FillRect::load($xmlReader, $element);

        return $stretch;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:stretch');

        $this->fillRect && $this->fillRect->write($writer);

        $writer->endElement();
    }
}

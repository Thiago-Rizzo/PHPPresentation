<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\FillToRect;

class Path
{
    public string $path = '';
    public ?FillToRect $fillToRect = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:path', $node);
        if (!$dom) {
            return null;
        }

        return self::loadByElement($xmlReader, $dom);
    }

    public static function loadByElement(XMLReader $xmlReader, DOMElement $node): self
    {
        $path = new self();
        $path->path = $node->getAttribute('path');

        $path->fillToRect = FillToRect::load($xmlReader, $node);

        return $path;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:path');

        $this->path && $writer->writeAttribute('path', $this->path);

        $this->fillToRect && $this->fillToRect->write($writer);

        $writer->endElement();
    }
}

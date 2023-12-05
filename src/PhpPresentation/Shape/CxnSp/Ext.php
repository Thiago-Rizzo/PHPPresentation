<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Ext
{
    public string $uri = '';
    public string $cx = '';
    public string $cy = '';

    public ?CreationId $creationId = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:ext', $node);
        if (!$element) {
            return null;
        }

        $ext = new self();

        $ext->uri = $element->getAttribute('uri');
        $ext->cx = $element->getAttribute('cx');
        $ext->cy = $element->getAttribute('cy');

//        $ext->creationId = CreationId::load($xmlReader, $element);

        return $ext;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:ext');

        $this->uri !== '' && $writer->writeAttribute('uri', $this->uri);
        $this->cx !== '' && $writer->writeAttribute('cx', $this->cx);
        $this->cy !== '' && $writer->writeAttribute('cy', $this->cy);

//        $this->creationId && $this->creationId->write($writer);

        $writer->endElement();
    }
}

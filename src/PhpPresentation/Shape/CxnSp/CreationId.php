<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class CreationId
{
    public string $id = '';
    public string $xmlnsA16 = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a16:creationId', $node);
        if (!$element) {
            return null;
        }

        $creationId = new self();

        $creationId->id = $element->getAttribute('id');
        $creationId->xmlnsA16 = $element->getAttribute('xmlns:a16');

        return $creationId;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a16:creationId');

        $this->id !== '' && $writer->writeAttribute('id', $this->id);
        $this->xmlnsA16 !== '' && $writer->writeAttribute('xmlns:a16', $this->xmlnsA16);

        $writer->endElement();
    }
}

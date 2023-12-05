<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class CNvPr
{
    public string $id = '';
    public string $name = '';

    public ?ExtLst $extLst = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:cNvPr', $node);
        if (!$element) {
            return null;
        }

        $nvPr = new self();

        $nvPr->id = $element->getAttribute('id');
        $nvPr->name = $element->getAttribute('name');

//        $nvPr->extLst = ExtLst::load($xmlReader, $element);

        return $nvPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:cNvPr');

        $this->id !== '' && $writer->writeAttribute('id', $this->id);
        $this->name !== '' && $writer->writeAttribute('name', $this->name);

//        $this->extLst && $this->extLst->write($writer);

        $writer->endElement();
    }
}

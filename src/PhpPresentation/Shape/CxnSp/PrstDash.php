<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class PrstDash
{
    public string $val = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:prstDash', $node);
        if (!$element) {
            return null;
        }

        $dash = new self();

        $dash->val = $element->getAttribute('val');

        return $dash;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:prstDash');
        $this->val !== '' && $writer->writeAttribute('val', $this->val);
        $writer->endElement();
    }
}

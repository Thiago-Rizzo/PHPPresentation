<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class PicLocks
{
    public string $noChangeAspect = '';
    public string $noGrp = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:picLocks', $node);
        if (!$element) {
            return null;
        }

        $picLocks = new self();

        $picLocks->noChangeAspect = $element->getAttribute('noChangeAspect');
        $picLocks->noGrp = $element->getAttribute('noGrp');

        return $picLocks;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:picLocks');

        $this->noChangeAspect != '' && $writer->writeAttribute('noChangeAspect', $this->noChangeAspect);
        $this->noGrp != '' && $writer->writeAttribute('noGrp', $this->noGrp);

        $writer->endElement();
    }
}

<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Xfrm
{
    public ?Off $off = null;
    public ?Ext $ext = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:xfrm', $node);
        if (!$element) {
            return null;
        }

        $xfrm = new self();

        $xfrm->off = Off::load($xmlReader, $element);
        $xfrm->ext = Ext::load($xmlReader, $element);

        return $xfrm;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:xfrm');

        $this->off && $this->off->write($writer);
        $this->ext && $this->ext->write($writer);

        $writer->endElement();
    }
}

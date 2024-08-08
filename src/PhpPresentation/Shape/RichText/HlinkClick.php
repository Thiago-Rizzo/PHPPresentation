<?php

namespace PhpOffice\PhpPresentation\Shape\RichText;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class HlinkClick
{
    public string $action = '';
    public string $target = '';
    public string $tooltip = '';
    public string $id = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:hlinkClick', $node);
        if (!$dom) {
            return null;
        }

        $hlinkClick = new self();

        $hlinkClick->action = $dom->getAttribute('action');
        $hlinkClick->target = $dom->getAttribute('target');
        $hlinkClick->tooltip = $dom->getAttribute('tooltip');

        return $hlinkClick;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:hlinkClick');

        $this->action !== '' && $writer->writeAttribute('action', $this->action);
        $this->target !== '' && $writer->writeAttribute('target', $this->target);
        $this->tooltip !== '' && $writer->writeAttribute('tooltip', $this->tooltip);

        $this->id !== '' && $writer->writeAttribute('r:id', $this->id);

        $writer->endElement();
    }
}

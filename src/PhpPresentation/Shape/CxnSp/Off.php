<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\Drawing as CommonDrawing;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Off
{
    public ?int $x = null;
    public ?int $y = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:off', $node);
        if (!$dom) {
            return null;
        }

        $off = new self();

        if ($dom->hasAttribute('x')) {
            $off->x = CommonDrawing::emuToPixels((int)$dom->getAttribute('x'));
        }

        if ($dom->hasAttribute('y')) {
            $off->y = CommonDrawing::emuToPixels((int)$dom->getAttribute('y'));
        }

        return $off;
    }

    public function write(XMLWriter $writer, $shape = null): void
    {
        $writer->startElement('a:off');

        $this->x ??= $shape->getOffsetX() ?? 0;
        $this->y ??= $shape->getOffsetY() ?? 0;

        $writer->writeAttribute('x', CommonDrawing::pixelsToEmu((float)$this->x));
        $writer->writeAttribute('y', CommonDrawing::pixelsToEmu((float)$this->y));

        $writer->endElement();
    }
}

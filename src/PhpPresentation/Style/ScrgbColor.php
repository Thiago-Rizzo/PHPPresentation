<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Style;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class ScrgbColor extends Color
{
    protected string $red = '';
    protected string $green = '';
    protected string $blue = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?Color
    {
        $element = $xmlReader->getElement('a:scrgbClr', $node);
        if (!$element) {
            return null;
        }

        $color = new self();

        $color->red = $element->getAttribute('r');
        $color->green = $element->getAttribute('g');
        $color->blue = $element->getAttribute('b');

        return $color;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:scrgbClr');

        $this->red !== '' && $writer->writeAttribute('r', $this->red);
        $this->green !== '' && $writer->writeAttribute('g', $this->green);
        $this->blue !== '' && $writer->writeAttribute('b', $this->blue);

        $writer->endElement();
    }
}

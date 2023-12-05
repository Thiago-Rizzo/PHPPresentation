<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Fill;

class Ln
{
    public string $w = '';
    public string $cap = '';
    public string $cmpd = '';

    public ?Fill $fill = null;
    public ?PrstDash $prstDash = null;
    public ?Miter $miter = null;
    public ?HeadEnd $headEnd = null;
    public ?TailEnd $tailEnd = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:ln', $node);
        if (!$element) {
            return null;
        }

        $ln = new self();

        $ln->w = $element->getAttribute('w');
        $ln->cap = $element->getAttribute('cap');
        $ln->cmpd = $element->getAttribute('cmpd');

        $ln->fill = Fill::load($xmlReader, $element);
        $ln->prstDash = PrstDash::load($xmlReader, $element);
        $ln->miter = Miter::load($xmlReader, $element);
        $ln->headEnd = HeadEnd::load($xmlReader, $element);
        $ln->tailEnd = TailEnd::load($xmlReader, $element);

        return $ln;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:ln');

        $this->w !== '' && $writer->writeAttribute('w', $this->w);
        $this->cap !== '' && $writer->writeAttribute('cap', $this->cap);
        $this->cmpd !== '' && $writer->writeAttribute('cmpd', $this->cmpd);

        $this->fill && $this->fill->write($writer);
        $this->prstDash && $this->prstDash->write($writer);
        $this->miter && $this->miter->write($writer);
        $this->headEnd && $this->headEnd->write($writer);
        $this->tailEnd && $this->tailEnd->write($writer);

        $writer->endElement();
    }
}

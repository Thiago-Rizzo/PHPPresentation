<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\Para;

use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Fill;
use DOMElement;

class EndParaRPr
{
    public ?Fill $fill = null;
    public ?Latin $latin = null;
    public ?Ea $ea = null;
    public ?Cs $cs = null;
    public ?Sym $sym = null;

    public string $sz = '';
    public string $b = '';
    public string $i = '';
    public string $u = '';
    public string $strike = '';
    public string $cap = '';
    public string $dirty = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:endParaRPr', $node);
        if (!$dom) {
            return null;
        }

        $endParaRPr = new self();

        $endParaRPr->sz = $dom->getAttribute('sz');
        $endParaRPr->b = $dom->getAttribute('b');
        $endParaRPr->i = $dom->getAttribute('i');
        $endParaRPr->u = $dom->getAttribute('u');
        $endParaRPr->strike = $dom->getAttribute('strike');
        $endParaRPr->cap = $dom->getAttribute('cap');
        $endParaRPr->dirty = $dom->getAttribute('dirty');

        $endParaRPr->fill = Fill::load($xmlReader, $dom);
        $endParaRPr->latin = Latin::load($xmlReader, $dom);
        $endParaRPr->ea = Ea::load($xmlReader, $dom);
        $endParaRPr->cs = Cs::load($xmlReader, $dom);
        $endParaRPr->sym = Sym::load($xmlReader, $dom);

        return $endParaRPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:endParaRPr');

        $this->sz != '' && $writer->writeAttribute('sz', $this->sz);
        $this->b != '' && $writer->writeAttribute('b', $this->b);
        $this->i != '' && $writer->writeAttribute('i', $this->i);
        $this->u != '' && $writer->writeAttribute('u', $this->u);
        $this->strike != '' && $writer->writeAttribute('strike', $this->strike);
        $this->cap != '' && $writer->writeAttribute('cap', $this->cap);
        $this->dirty != '' && $writer->writeAttribute('dirty', $this->dirty);

        $this->fill && $this->fill->write($writer);
        $this->latin && $this->latin->write($writer);
        $this->ea && $this->ea->write($writer);
        $this->cs && $this->cs->write($writer);
        $this->sym && $this->sym->write($writer);

        $writer->endElement();
    }
}

<?php

namespace PhpOffice\PhpPresentation\Shape\RichText;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Shape\RichText\Para\Cs;
use PhpOffice\PhpPresentation\Shape\RichText\Para\Ea;
use PhpOffice\PhpPresentation\Shape\RichText\Para\Latin;
use PhpOffice\PhpPresentation\Shape\RichText\Para\Sym;
use PhpOffice\PhpPresentation\Style\Fill;

class RPr
{
    public ?Fill $fill = null;
    public ?Latin $latin = null;
    public ?Ea $ea = null;
    public ?Cs $cs = null;
    public ?Sym $sym = null;
    public ?HlinkClick $hlinkClick = null;

    public string $sz = '';
    public string $b = '';
    public string $i = '';
    public string $u = '';
    public string $strike = '';
    public string $cap = '';
    public string $dirty = '';
    public string $lang = '';
    public string $spc = '';

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:rPr', $node);
        if (!$dom) {
            return null;
        }

        $rPr = new self();

        $rPr->sz = $dom->getAttribute('sz');
        $rPr->b = $dom->getAttribute('b');
        $rPr->i = $dom->getAttribute('i');
        $rPr->u = $dom->getAttribute('u');
        $rPr->strike = $dom->getAttribute('strike');
        $rPr->cap = $dom->getAttribute('cap');
        $rPr->dirty = $dom->getAttribute('dirty');
        $rPr->lang = $dom->getAttribute('lang');
        $rPr->spc = $dom->getAttribute('spc');

        $rPr->fill = Fill::load($xmlReader, $dom);
        $rPr->latin = Latin::load($xmlReader, $dom);
        $rPr->ea = Ea::load($xmlReader, $dom);
        $rPr->cs = Cs::load($xmlReader, $dom);
        $rPr->sym = Sym::load($xmlReader, $dom);
        $rPr->hlinkClick = HlinkClick::load($xmlReader, $dom);

        return $rPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:rPr');

        $this->lang !== '' && $writer->writeAttribute('lang', $this->lang);
        $this->sz !== '' && $writer->writeAttribute('sz', $this->sz);
        $this->b !== '' && $writer->writeAttribute('b', $this->b);
        $this->i !== '' && $writer->writeAttribute('i', $this->i);
        $this->u !== '' && $writer->writeAttribute('u', $this->u);
        $this->strike !== '' && $writer->writeAttribute('strike', $this->strike);
        $this->cap !== '' && $writer->writeAttribute('cap', $this->cap);
        $this->dirty !== '' && $writer->writeAttribute('dirty', $this->dirty);
        $this->spc !== '' && $writer->writeAttribute('spc', $this->spc);

        $this->fill && $this->fill->write($writer);
        $this->latin && $this->latin->write($writer);
        $this->ea && $this->ea->write($writer);
        $this->cs && $this->cs->write($writer);
        $this->sym && $this->sym->write($writer);
        $this->hlinkClick && $this->hlinkClick->write($writer);

        $writer->endElement();
    }
}

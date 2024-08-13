<?php

namespace PhpOffice\PhpPresentation\Shape\RichText\BodyPr;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class BodyPr
{
    public string $lIns = '';
    public string $tIns = '';
    public string $rIns = '';
    public string $bIns = '';
    public string $anchor = '';
    public string $rtlCol = '';
    public string $wrap = '';
    public string $horzOverflow = '';
    public string $vertOverflow = '';
    public string $upright = '';
    public string $vert = '';
    public string $numCol = '';
    public string $spcCol = '';

    public ?NormAutofit $normAutoFit = null;
    public ?SpAutoFit $spAutoFit = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:bodyPr', $node);
        if (!$dom) {
            return null;
        }

        $bodyPr = new self();

        $bodyPr->lIns = $dom->getAttribute('lIns');
        $bodyPr->tIns = $dom->getAttribute('tIns');
        $bodyPr->rIns = $dom->getAttribute('rIns');
        $bodyPr->bIns = $dom->getAttribute('bIns');
        $bodyPr->anchor = $dom->getAttribute('anchor');
        $bodyPr->rtlCol = $dom->getAttribute('rtlCol');
        $bodyPr->wrap = $dom->getAttribute('wrap');
        $bodyPr->horzOverflow = $dom->getAttribute('horzOverflow');
        $bodyPr->vertOverflow = $dom->getAttribute('vertOverflow');
        $bodyPr->upright = $dom->getAttribute('upright');
        $bodyPr->vert = $dom->getAttribute('vert');
        $bodyPr->numCol = $dom->getAttribute('numCol');
        $bodyPr->spcCol = $dom->getAttribute('spcCol');

        $bodyPr->normAutoFit = NormAutofit::load($xmlReader, $dom);
        $bodyPr->spAutoFit = SpAutoFit::load($xmlReader, $dom);

        return $bodyPr;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:bodyPr');

        $this->lIns !== '' && $writer->writeAttribute('lIns', $this->lIns);
        $this->tIns !== '' && $writer->writeAttribute('tIns', $this->tIns);
        $this->rIns !== '' && $writer->writeAttribute('rIns', $this->rIns);
        $this->bIns !== '' && $writer->writeAttribute('bIns', $this->bIns);
        $this->anchor !== '' && $writer->writeAttribute('anchor', $this->anchor);
        $this->rtlCol !== '' && $writer->writeAttribute('rtlCol', $this->rtlCol);
        $this->wrap !== '' && $writer->writeAttribute('wrap', $this->wrap);
        $this->horzOverflow !== '' && $writer->writeAttribute('horzOverflow', $this->horzOverflow);
        $this->vertOverflow !== '' && $writer->writeAttribute('vertOverflow', $this->vertOverflow);
        $this->upright !== '' && $writer->writeAttribute('upright', $this->upright);
        $this->vert !== '' && $writer->writeAttribute('vert', $this->vert);
        $this->numCol !== '' && $writer->writeAttribute('numCol', $this->numCol);
        $this->spcCol !== '' && $writer->writeAttribute('spcCol', $this->spcCol);

        $this->normAutoFit && $this->normAutoFit->write($writer);
        $this->spAutoFit && $this->spAutoFit->write($writer);

        $writer->endElement();
    }
}

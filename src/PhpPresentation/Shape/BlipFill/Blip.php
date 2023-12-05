<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Blip
{
    public string $embed = '';

    public ?AlphaModFix $alphaModFix = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('a:blip', $node);
        if (!$element) {
            return null;
        }

        $blip = new self();

        $blip->embed = $element->getAttribute('r:embed');

        $blip->alphaModFix = AlphaModFix::load($xmlReader, $element);

        return $blip;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:blip');

        $this->embed !== '' && $writer->writeAttribute('r:embed', $this->embed);


        //        if ($shape instanceof AbstractDrawingAdapter && $shape->getExtension() == 'svg') {
        //            // a:extLst
        //            $objWriter->startElement('a:extLst');
        //
        //            // a:extLst > a:ext
        //            $objWriter->startElement('a:ext');
        //            $objWriter->writeAttribute('uri', '{28A0092B-C50C-407E-A947-70E740481C1C}');
        //            // a:extLst > a:ext > a14:useLocalDpi
        //            $objWriter->startElement('a14:useLocalDpi');
        //            $objWriter->writeAttribute('xmlns:a14', 'http://schemas.microsoft.com/office/drawing/2010/main');
        //            $objWriter->writeAttribute('val', '0');
        //            // a:extLst > a:ext > ##a14:useLocalDpi
        //            $objWriter->endElement();
        //            // a:extLst > ##a:ext
        //            $objWriter->endElement();
        //
        //            // a:extLst > a:ext
        //            $objWriter->startElement('a:ext');
        //            $objWriter->writeAttribute('uri', '{96DAC541-7B7A-43D3-8B79-37D633B846F1}');
        //            // a:extLst > a:ext > asvg:svgBlip
        //            $objWriter->startElement('asvg:svgBlip');
        //            $objWriter->writeAttribute('xmlns:asvg', 'http://schemas.microsoft.com/office/drawing/2016/SVG/main');
        //            $objWriter->writeAttribute('r:embed', $shape->relationId);
        //            // a:extLst > a:ext > ##asvg:svgBlip
        //            $objWriter->endElement();
        //            // a:extLst > ##a:ext
        //            $objWriter->endElement();
        //
        //            // ##a:extLst
        //            $objWriter->endElement();
        //        }

        $this->alphaModFix && $this->alphaModFix->write($writer);

        $writer->endElement();
    }

    /**
     * @param string $embed
     */
    public function setEmbed(string $embed = ''): void
    {
        $this->embed = $embed;
    }

    /**
     * @return string
     */
    public function getEmbed(): string
    {
        return $this->embed;
    }

    public function getAlphaModFix(): ?AlphaModFix
    {
        return $this->alphaModFix;
    }

    public function setAlphaModFix(?AlphaModFix $alphaModFix = null): void
    {
        $this->alphaModFix = $alphaModFix;
    }
}

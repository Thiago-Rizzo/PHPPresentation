<?php

namespace PhpOffice\PhpPresentation\Style\Fill;

use DOMElement;
use PhpOffice\Common\Drawing as CommonDrawing;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Fill;

class GradFill extends Fill
{
    public ?GsLst $gsLst = null;
    public ?Path $path = null;
    public ?TileRect $tileRect = null;

    public string $flip = '';
    public string $rotWithShape = '';
    public ?string $ang = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:gradFill', $node);
        if (!$dom) {
            return null;
        }

        $fill = new self();
        $fill->setFillType(self::FILL_GRADIENT);

        $fill->gsLst = GsLst::load($xmlReader, $dom);
        $fill->path = Path::load($xmlReader, $dom);
        $fill->tileRect = TileRect::load($xmlReader, $dom);

        if ($dom->hasAttribute('ang')) {
            $fill->ang = CommonDrawing::angleToDegrees((int)$dom->getAttribute('ang'));
        }

        $fill->flip = $dom->getAttribute('flip');
        $fill->rotWithShape = $dom->getAttribute('rotWithShape');

        return $fill;
    }


    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:gradFill');

        $this->ang !== null && $writer->writeAttribute('ang', CommonDrawing::degreesToAngle($this->ang));
        $this->flip !== '' && $writer->writeAttribute('flip', $this->flip);
        $this->rotWithShape !== '' && $writer->writeAttribute('rotWithShape', $this->rotWithShape);

        $this->gsLst && $this->gsLst->write($writer);
        $this->path && $this->path->write($writer);
        $this->tileRect && $this->tileRect->write($writer);

        $writer->endElement();
    }
}

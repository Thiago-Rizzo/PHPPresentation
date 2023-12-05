<?php

namespace PhpOffice\PhpPresentation\Shape\BlipFill;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class BlipFill
{
    public string $rotWithShape = '';

    public ?Blip $blip = null;
    public ?Stretch $stretch = null;
    public ?SrcRect $srcRect = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $element = $xmlReader->getElement('p:blipFill', $node);
        if (!$element) {
            return null;
        }

        $blipFill = new self();

        $blipFill->rotWithShape = $element->getAttribute('rotWithShape');

        $blipFill->blip = Blip::load($xmlReader, $element);
        $blipFill->srcRect = SrcRect::load($xmlReader, $element);
        $blipFill->stretch = Stretch::load($xmlReader, $element);

        return $blipFill;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('p:blipFill');

        $this->rotWithShape !== '' && $writer->writeAttribute('rotWithShape', $this->rotWithShape);

        $this->blip && $this->blip->write($writer);
        $this->srcRect && $this->srcRect->write($writer);
        $this->stretch && $this->stretch->write($writer);

        $writer->endElement();
    }

    public function getRotWithShape(): string
    {
        return $this->rotWithShape;
    }

    public function setRotWithShape(string $rotWithShape = ''): void
    {
        $this->rotWithShape = $rotWithShape;
    }

    public function getBlip(): ?Blip
    {
        return $this->blip;
    }

    public function setBlip(?Blip $blip = null): void
    {
        $this->blip = $blip;
    }

    public function getStretch(): ?Stretch
    {
        return $this->stretch;
    }

    public function setStretch(?Stretch $stretch = null): void
    {
        $this->stretch = $stretch;
    }

    public function getSrcRect(): ?SrcRect
    {
        return $this->srcRect;
    }

    public function setSrcRect(?SrcRect $srcRect = null): void
    {
        $this->srcRect = $srcRect;
    }
}

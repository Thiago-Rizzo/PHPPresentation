<?php

namespace PhpOffice\PhpPresentation\Shape\CxnSp;

use DOMElement;
use PhpOffice\Common\Drawing as CommonDrawing;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class Ext
{
    public string $uri = '';
    public ?int $cx = null;
    public ?int $cy = null;

    public ?CreationId $creationId = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:ext', $node);
        if (!$dom) {
            return null;
        }

        $ext = new self();

        $ext->uri = $dom->getAttribute('uri');

        if ($dom->hasAttribute('cx')) {
            $ext->cx = CommonDrawing::emuToPixels((int)$dom->getAttribute('cx'));
        }

        if ($dom->hasAttribute('cy')) {
            $ext->cy = CommonDrawing::emuToPixels((int)$dom->getAttribute('cy'));
        }

//        $ext->creationId = CreationId::load($xmlReader, $dom);

        return $ext;
    }

    public function write(XMLWriter $writer, $shape = null ): void
    {
        $writer->startElement('a:ext');

        $this->uri !== '' && $writer->writeAttribute('uri', $this->uri);

        $this->cx ??= $shape->getWidth() ?? 0;
        $this->cy ??= $shape->getHeight() ?? 0;

        $writer->writeAttribute('cx', CommonDrawing::pixelsToEmu((float)$this->cx));
        $writer->writeAttribute('cy', CommonDrawing::pixelsToEmu((float)$this->cy));

//        $this->creationId && $this->creationId->write($writer);

        $writer->endElement();
    }
}

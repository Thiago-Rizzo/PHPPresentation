<?php

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Shape\Geometry;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;

class PathLst
{
    public ?Path $path = null;

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $dom = $xmlReader->getElement('a:pathLst', $node);
        if (!$dom) {
            return null;
        }

        $pathLst = new self();

        $pathLst->path = Path::load($xmlReader, $dom);

        return $pathLst;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:pathLst');
        $this->path && $this->path->write($writer);
        $writer->endElement();
    }
}
<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Style;

use DOMElement;
use PhpOffice\Common\XMLReader;
use PhpOffice\Common\XMLWriter;
use PhpOffice\PhpPresentation\Style\Color\LumMod;
use PhpOffice\PhpPresentation\Style\Color\LumOff;

class SchemeColor extends Color
{
    protected string $value = '';
    protected ?string $shade = null;

    public ?LumMod $lumMod = null;
    public ?LumOff $lumOff = null;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setShade(?string $shade): self
    {
        $this->shade = $shade;

        return $this;
    }

    public function getShade(): ?string
    {
        return $this->shade;
    }

    public static function load(XMLReader $xmlReader, DOMElement $node): ?Color
    {
        $element = $xmlReader->getElement('a:schemeClr', $node);
        if (!$element) {
            return null;
        }

        $color = new self();
        $color->setValue($element->getAttribute('val'));

        $elementShade = $xmlReader->getElement('a:shade', $element);
        if ($elementShade instanceof DOMElement && $elementShade->hasAttribute('val')) {
            $color->setShade($elementShade->getAttribute('val'));
        }

        $elementAlpha = $xmlReader->getElement('a:alpha', $element);
        if ($elementAlpha instanceof DOMElement && $elementAlpha->hasAttribute('val')) {
            $alpha = $elementAlpha->getAttribute('val') / 1000;
            $color->setAlpha($alpha);
        }

        $color->lumMod = LumMod::load($xmlReader, $element);
        $color->lumOff = LumOff::load($xmlReader, $element);

        return $color;
    }

    public function write(XMLWriter $writer): void
    {
        $writer->startElement('a:schemeClr');

        $this->getValue() !== '' && $writer->writeAttribute('val', $this->getValue());

        if ($this->getShade() !== null) {
            $writer->startElement('a:shade');
            $writer->writeAttribute('val', $this->getShade());
            $writer->endElement();
        }

        if ($this->getAlpha() !== 100) {
            $writer->startElement('a:alpha');
            $writer->writeAttribute('val', $this->getAlpha() * 1000);
            $writer->endElement();
        }

        $this->lumMod && $this->lumMod->write($writer);
        $this->lumOff && $this->lumOff->write($writer);

        $writer->endElement();
    }
}

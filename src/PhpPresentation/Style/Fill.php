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
use PhpOffice\PhpPresentation\ComparableInterface;
use PhpOffice\PhpPresentation\Style\Fill\GradFill;

class Fill implements ComparableInterface
{
    /* Fill types */
    public const FILL_NONE = 'none';
    public const FILL_SOLID = 'solid';
    public const FILL_GRADIENT = 'grad';
    public const FILL_PATTERN_DARKDOWN = 'darkDown';
    public const FILL_PATTERN_DARKGRAY = 'darkGray';
    public const FILL_PATTERN_DARKGRID = 'darkGrid';
    public const FILL_PATTERN_DARKHORIZONTAL = 'darkHorizontal';
    public const FILL_PATTERN_DARKTRELLIS = 'darkTrellis';
    public const FILL_PATTERN_DARKUP = 'darkUp';
    public const FILL_PATTERN_DARKVERTICAL = 'darkVertical';
    public const FILL_PATTERN_GRAY0625 = 'gray0625';
    public const FILL_PATTERN_GRAY125 = 'gray125';
    public const FILL_PATTERN_LIGHTDOWN = 'lightDown';
    public const FILL_PATTERN_LIGHTGRAY = 'lightGray';
    public const FILL_PATTERN_LIGHTGRID = 'lightGrid';
    public const FILL_PATTERN_LIGHTHORIZONTAL = 'lightHorizontal';
    public const FILL_PATTERN_LIGHTTRELLIS = 'lightTrellis';
    public const FILL_PATTERN_LIGHTUP = 'lightUp';
    public const FILL_PATTERN_LIGHTVERTICAL = 'lightVertical';
    public const FILL_PATTERN_MEDIUMGRAY = 'mediumGray';

    /**
     * Fill type.
     *
     * @var string
     */
    private $fillType = self::FILL_NONE;

    /**
     * Rotation.
     *
     * @var float
     */
    private $rotation = 0.0;

    /**
     * Start color.
     *
     * @var Color
     */
    private $startColor;

    /**
     * End color.
     *
     * @var Color
     */
    private $endColor;

    /**
     * Hash index.
     *
     * @var int
     */
    private $hashIndex;

    /**
     * Create a new \PhpOffice\PhpPresentation\Style\Fill.
     */
    public function __construct()
    {
        $this->startColor = new Color(Color::COLOR_BLACK);
        $this->endColor = new Color(Color::COLOR_WHITE);
    }

    /**
     * Get Fill Type.
     *
     * @return string
     */
    public function getFillType(): string
    {
        return $this->fillType;
    }

    /**
     * Set Fill Type.
     *
     * @param string $pValue Fill type
     *
     * @return self
     */
    public function setFillType(string $pValue = self::FILL_NONE): self
    {
        $this->fillType = $pValue;

        return $this;
    }

    /**
     * Get Rotation.
     *
     * @return float
     */
    public function getRotation(): float
    {
        return $this->rotation;
    }

    /**
     * Set Rotation.
     *
     * @param float $pValue
     *
     * @return self
     */
    public function setRotation(float $pValue = 0): self
    {
        $this->rotation = $pValue;

        return $this;
    }

    /**
     * Get Start Color.
     *
     * @return Color
     */
    public function getStartColor(): Color
    {
        // It's a get but it may lead to a modified color which we won't detect but in which case we must bind.
        // So bind as an assurance.
        return $this->startColor;
    }

    /**
     * Set Start Color.
     *
     * @param Color $pValue
     *
     * @return self
     */
    public function setStartColor(?Color $pValue = null): self
    {
        $this->startColor = $pValue ?? new Color(Color::COLOR_BLACK);

        return $this;
    }

    /**
     * Get End Color.
     *
     * @return Color
     */
    public function getEndColor(): Color
    {
        // It's a get but it may lead to a modified color which we won't detect but in which case we must bind.
        // So bind as an assurance.
        return $this->endColor;
    }

    /**
     * Set End Color.
     *
     * @param Color $pValue
     *
     * @return self
     */
    public function setEndColor(?Color $pValue = null): self
    {
        $this->endColor = $pValue ?? new Color(Color::COLOR_WHITE);

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode(): string
    {
        return md5(
            $this->getFillType()
            . $this->getRotation()
            . $this->getStartColor()->getHashCode()
            . $this->getEndColor()->getHashCode()
            . __CLASS__
        );
    }

    /**
     * Get hash index.
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @return int|null Hash index
     */
    public function getHashIndex(): ?int
    {
        return $this->hashIndex;
    }

    /**
     * Set hash index.
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @param int $value Hash index
     *
     * @return $this
     */
    public function setHashIndex(int $value)
    {
        $this->hashIndex = $value;

        return $this;
    }

    public static function load(XMLReader $xmlReader, DOMElement $node): ?self
    {
        $fill = new self();

        $element = $xmlReader->getElement('a:solidFill', $node);
        if ($element) {
            $fill->setFillType(self::FILL_SOLID);
        } else {
            $element = $xmlReader->getElement('a:noFill', $node);
            if ($element) {
                $fill->setFillType(self::FILL_NONE);
            } else {
                $element = $xmlReader->getElement('a:gradFill', $node);
                if ($element) {
                    $fill->setFillType(self::FILL_GRADIENT);
                } else {
                    $element = $xmlReader->getElement('a:pattFill', $node);
                    if ($element) {
                        $fill->setFillType(self::FILL_PATTERN_DARKGRAY);
                    }
                }
            }
        }

        if (!$element) {
            return null;
        }

        if ($fill->getFillType() == self::FILL_SOLID) {

            $fill->setStartColor(Color::identify($xmlReader, $element));

        } elseif ($fill->getFillType() == self::FILL_GRADIENT) {

            $fill = GradFill::load($xmlReader, $node);

        } elseif ($fill->getFillType() == self::FILL_PATTERN_DARKDOWN) {

            $elementPattern = $xmlReader->getElement('a:fgClr', $element);
            if ($elementPattern) {
                $fill->setStartColor(Color::identify($xmlReader, $elementPattern));
            }

            $elementPattern = $xmlReader->getElement('a:bgClr', $element);
            if ($elementPattern) {
                $fill->setEndColor(Color::identify($xmlReader, $elementPattern));
            }
        }

        return $fill;
    }

    public function write(XMLWriter $writer): void
    {
        if ($this->getFillType() == Fill::FILL_NONE) {
            $writer->startElement('a:noFill');
            $writer->endElement();

            return;
        }

        if ($this->getFillType() == Fill::FILL_SOLID) {
            $writer->startElement('a:solidFill');
            $this->getStartColor()->write($writer);
            $writer->endElement();

            return;
        }

        $writer->startElement('a:pattFill');

        $writer->startElement('a:fgClr');
        $this->getStartColor()->write($writer);
        $writer->endElement();

        $writer->startElement('a:bgClr');
        $this->getEndColor()->write($writer);
        $writer->endElement();

        $writer->endElement();
    }
}

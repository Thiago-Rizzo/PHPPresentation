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

namespace PhpOffice\PhpPresentation\Shape;

use PhpOffice\PhpPresentation\AbstractShape;
use PhpOffice\PhpPresentation\Shape\BlipFill\BlipFill;
use PhpOffice\PhpPresentation\Shape\Geometry\Geometry;

/**
 * Abstract drawing.
 */
abstract class AbstractGraphic extends AbstractShape
{
    /**
     * Image counter.
     *
     * @var int
     */
    private static $imageCounter = 0;

    /**
     * Image index.
     *
     * @var int
     */
    private $imageIndex = 0;

    /**
     * Name.
     *
     * @var string
     */
    protected $name;

    /**
     * Description.
     *
     * @var string
     */
    protected $description;

    /**
     * Proportional resize.
     *
     * @var bool
     */
    protected $resizeProportional;

    /**
     * Slide relation ID (should not be used by user code!).
     *
     * @var string
     */
    public $relationId = null;

    public ?Geometry $geometry = null;

    public ?BlipFill $blipFill = null;

    /**
     * Create a new \PhpOffice\PhpPresentation\Slide\AbstractDrawing.
     */
    public function __construct()
    {
        // Initialise values
        $this->name = '';
        $this->description = '';
        $this->resizeProportional = true;

        // Set image index
        ++self::$imageCounter;
        $this->imageIndex = self::$imageCounter;

        // Initialize parent
        parent::__construct();
    }

    public function __clone()
    {
        parent::__clone();

        ++self::$imageCounter;
        $this->imageIndex = self::$imageCounter;
    }

    /**
     * Get image index.
     *
     * @return int
     */
    public function getImageIndex()
    {
        return $this->imageIndex;
    }

    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name.
     *
     * @param string $pValue
     *
     * @return $this
     */
    public function setName($pValue = '')
    {
        $this->name = $pValue;

        return $this;
    }

    /**
     * Get Description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Description.
     *
     * @param string $pValue
     *
     * @return $this
     */
    public function setDescription($pValue = '')
    {
        $this->description = $pValue;

        return $this;
    }

    /**
     * Set Width.
     *
     * @return self
     */
    public function setWidth(int $pValue = 0)
    {
        // Resize proportional?
        if ($this->resizeProportional && 0 != $pValue && 0 != $this->width) {
            $ratio = $this->height / $this->width;
            $this->height = (int)round($ratio * $pValue);
        }

        // Set width
        $this->width = $pValue;

        return $this;
    }

    /**
     * Set Height.
     *
     * @return self
     */
    public function setHeight(int $pValue = 0)
    {
        // Resize proportional?
        if ($this->resizeProportional && 0 != $pValue && 0 != $this->height) {
            $ratio = $this->width / $this->height;
            $this->width = (int)round($ratio * $pValue);
        }

        // Set height
        $this->height = $pValue;

        return $this;
    }

    /**
     * Set width and height with proportional resize.
     *
     * @return self
     * @author Vincent@luo MSN:kele_100@hotmail.com
     *
     */
    public function setWidthAndHeight(int $width = 0, int $height = 0)
    {
        $xratio = $width / $this->width;
        $yratio = $height / $this->height;
        if ($this->resizeProportional && !(0 == $width || 0 == $height)) {
            if (($xratio * $this->height) < $height) {
                $this->height = (int)ceil($xratio * $this->height);
                $this->width = $width;
            } else {
                $this->width = (int)ceil($yratio * $this->width);
                $this->height = $height;
            }
        }

        return $this;
    }

    /**
     * Get ResizeProportional.
     *
     * @return bool
     */
    public function isResizeProportional()
    {
        return $this->resizeProportional;
    }

    /**
     * Set ResizeProportional.
     *
     * @param bool $pValue
     */
    public function setResizeProportional($pValue = true): self
    {
        $this->resizeProportional = $pValue;

        return $this;
    }

    public function setGeometry(?Geometry $geometry = null): self
    {
        $this->geometry = $geometry;

        return $this;
    }

    public function getGeometry(): ?Geometry
    {
        return $this->geometry;
    }

    public function setBlipFill(?BlipFill $blipFill = null): self
    {
        $this->blipFill = $blipFill;

        return $this;
    }

    public function getBlipFill(): ?BlipFill
    {
        return $this->blipFill;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode(): string
    {
        return md5($this->name . $this->description . parent::getHashCode() . __CLASS__);
    }
}

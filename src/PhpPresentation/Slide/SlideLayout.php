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

namespace PhpOffice\PhpPresentation\Slide;

use PhpOffice\PhpPresentation\Style\ColorMap;

class SlideLayout extends AbstractSlide
{
    /**
     * @var SlideMaster
     */
    protected $slideMaster;
    /**
     * Slide relation ID (should not be used by user code!).
     *
     * @var string
     */
    public $relationId;
    /**
     * Slide layout NR (should not be used by user code!).
     *
     * @var int
     */
    public $layoutNr;
    /**
     * Slide layout ID (should not be used by user code!).
     *
     * @var int
     */
    public $layoutId;
    /**
     * Slide layout ID (should not be used by user code!).
     *
     * @var string|null
     */
    protected $layoutName;
    /**
     * Mapping of colors to the theme.
     *
     * @var \PhpOffice\PhpPresentation\Style\ColorMap
     */
    public $colorMap;

    /**
     * Create a new slideLayout.
     */
    public function __construct(SlideMaster $pSlideMaster)
    {
        // Set parent
        $this->slideMaster = $pSlideMaster;
        // Shape collection
        $this->shapeCollection = new \ArrayObject();
        // Set identifier
        $this->identifier = md5(rand(0, 9999) . time());
        // Set a basic colorMap
        $this->colorMap = new ColorMap();
    }

    public function getLayoutName(): ?string
    {
        return $this->layoutName;
    }

    public function setLayoutName(string $layoutName): self
    {
        $this->layoutName = $layoutName;

        return $this;
    }

    public function getSlideMaster(): SlideMaster
    {
        return $this->slideMaster;
    }
}

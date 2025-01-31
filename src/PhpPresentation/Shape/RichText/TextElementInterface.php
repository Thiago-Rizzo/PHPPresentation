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

namespace PhpOffice\PhpPresentation\Shape\RichText;

/**
 * Rich text element interface.
 */
interface TextElementInterface
{
    /**
     * Get text.
     *
     * @return string Text
     */
    public function getText();

    /**
     * Set text.
     *
     * @param string $pText Text value
     *
     * @return \PhpOffice\PhpPresentation\Shape\RichText\TextElementInterface
     */
    public function setText($pText = '');

    /**
     * Get font.
     *
     * @return \PhpOffice\PhpPresentation\Style\Font
     */
    public function getFont();

    /**
     * @return string|null Language
     */
    public function getLanguage();

    /**
     * @param string $lang
     *
     * @return \PhpOffice\PhpPresentation\Shape\RichText\TextElementInterface
     */
    public function setLanguage($lang);

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode(): string;
}

<?php

namespace Tollwerk\TwOdl\ViewHelpers\Tcpdf;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Joschi Kuphal <joschi@tollwerk.de>, tollwerk® GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Render an image
 *
 * = Examples =
 *
 * <code title="Simple image">
 * <odl:tcpdf.image file="fileadmin/images/example.jpg"/>
 * </code>
 * <output>
 * Renders the image example.jpg top/left aligned to the current label. The image size will be the size of the original file.
 * </output>
 * 
 * <code title="Right aligned image with fixed width">
 * <odl:tcpdf.image file="fileadmin/images/example.jpg" align="right" width="30" top="5" right="5"/>
 * </code>
 * <output>
 * Renders the image example.jpg top/right aligned to the current label. The image width will be 30 units, whereas the height will be calculated automatically. The image will have 5 units offset to the upper right corner. 
 * </output>
 *
 * @api
 */
class ImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Render an image
	 * 
	 * @param \string $file				Image file
	 * @param \string $halign			Horizontal alignment (within the label)
	 * @param \float $width				Width (0 = original size respectively autocalculated if height > 0)
	 * @param \float $height			Height (0 = original size respectively autocalculated if width > 0)
	 * @param \float $top				Top margin
	 * @param \float $left				Left margin (if left aligned)
	 * @param \float $right				Right margin (if right aligned)
	 * @return void
	 */
	public function render($file, $halign = 'left', $width = 0, $height = 0, $top = 0, $left = 0, $right = 0) {
		try {
			$tcpdf			= (array)$this->templateVariableContainer->get('tcpdf');
			$this->templateVariableContainer->remove('tcpdf');
		} catch (\TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException $e) {
			$tcpdf			= array();
		}
		$args				= func_get_args();
		array_unshift($args, 'image');
		$tcpdf[]			= $args;
		$this->templateVariableContainer->add('tcpdf', $tcpdf);
	}
}

?>
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
 * Renders a text cell
 *
 * = Examples =
 *
 * <code title="Simple Text (enclosed content)">
 * <odl:tcpdf.text>Hello World!</odl:tcpdf.text>
 * </code>
 * <output>
 * Renders the text "Hello World!" to the top left corner of the current label.
 * </output>
 * 
 * <code title="Positioned text">
 * <odl:tcpdf.text text="Hello World!" x="10" y="20"/>
 * </code>
 * <output>
 * Also renders the text "Hello World!" (different content approach as above, see "text" attribute) to the current label, with a horizontal offset of 10 units and a vertical offset of 20 units (measured from the top left corner of the current label).
 * </output>
 * 
 * <code title="Bottom/right aligned text">
 * <odl:tcpdf.text text="Hello World!" width="50" height="50" halign="right" valign="bottom" cursor="1"/>
 * </code>
 * <output>
 * Renders the text "Hello World!" to the bottom right corner of a 50 x 50 unit text box. Finally the insertion cursor is moved to the start of the next line.
 * </output>
 *
 * <code title="Colored text">
 * <odl:tcpdf.text text="Hello World!" fontfamily="DroidSans" fontsize="16" fontcolor="{0: 255, 1: 0, 2: 0}"/>
 * </code>
 * <output>
 * Renders the text "Hello World!" in 16pt red DroidSans letters.
 * </output>
 * 
 * @api
 */
class TextViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Render a text
	 * 
	 * @param \string $text						Text string
	 * @param \float $width						Text width
	 * @param \float $height					Text height
	 * @param \float $x							Horizontal position
	 * @param \float $y							Vertical position
	 * @param \string $halign					Horizontal alignment (L: left, C: center, R: right)
	 * @param \string $fontfamily				Font family
	 * @param \string $fontstyle				Font style
	 * @param \float $fontsize					Font size
	 * @param \array $fontcolor					Font color (RGB array)
	 * @param \integer $cursor					Cursor position after the text rendering (0 = top/right to the written text, 1 = beginning of next line, 2 = below)
	 * @param \string $valign					Vertical alignment (T: top, M: middle, B: bottom)
	 * @return void
	 */
	public function render($text = null, $x = null, $y = null, $width = 0, $height = 0, $halign = 'L', $fontfamily = 'times', $fontstyle = 'R', $fontsize = 11, $fontcolor = array(0, 0, 0), $cursor = 0, $valign = 'T') {
		try {
			$tcpdf			= (array)$this->templateVariableContainer->get('tcpdf');
			$this->templateVariableContainer->remove('tcpdf');
		} catch (\TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException $e) {
			$tcpdf			= array();
		}
		$args				= func_get_args();
		if ($args[0] === null) {
			$args[0]		= $this->renderChildren();
		}
		$args[5]			= strlen(trim($halign)) ? substr(strtoupper(trim($halign)), 0, 1) : 'L'; 
		$args[6]			= strlen(trim($fontfamily)) ? strtolower(trim($fontfamily)) : 'times';
		$args[7]			= strlen(trim($fontstyle)) ? strtoupper(trim($fontstyle)) : 'R';
		$args[11]			= strlen(trim($valign)) ? substr(strtoupper(trim($valign)), 0, 1) : 'T';
		array_unshift($args, 'text');
		$tcpdf[]			= $args;
		$this->templateVariableContainer->add('tcpdf', $tcpdf);
	}
}

?>
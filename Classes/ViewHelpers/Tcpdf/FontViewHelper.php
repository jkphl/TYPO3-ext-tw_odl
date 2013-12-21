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
 * Registers a font
 *
 * = Examples =
 *
 * <code title="Simple font registration">
 * <odl:tcpdf.font family="DroidSans" fontfile="fileadmin/templates/fonts/DroidSans/DroidSans.ttf"/>
 * </code>
 * <output>
 * Registers the TrueType font file DroidSans.ttf as font family "DroidSans"
 * </output>
 * 
 * <code title="Registering a bold font variant">
 * <odl:tcpdf.font family="DroidSans" style="B" fontfile="fileadmin/templates/fonts/DroidSans/DroidSans-Bold.ttf"/>
 * </code>
 * <output>
 * Registers the bold font variant of the font family "DroidSans"
 * </output> 
 * 
 * @api
 */
class FontViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Register a font
	 * 
	 * @param \string $family				Font family name
	 * @param \string $fontfile				TrueType font file
	 * @param \string $style				Font style. Possible values are (case insensitive)
	 * 											B: bold
	 * 											I: italic
	 * 											U: underline
	 * 											D: line trough
	 * 											O: overline
	 * 										or any combination. The default value is regular (empty string). Bold and italic styles do not apply to Symbol and ZapfDingbats basic fonts or other fonts when not defined.
	 * @return void
	 * @see \TCPDF::AddFont()
	 */
	public function render($family, $fontfile, $style = '') {
		$family				= trim($family);
		$fontfile			= trim($fontfile);
		if (strlen($family) && strlen($fontfile)) {
			try {
				$tcpdf		= (array)$this->templateVariableContainer->get('tcpdf');
				$this->templateVariableContainer->remove('tcpdf');
			} catch (\TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException $e) {
				$tcpdf		= array();
			}
			$tcpdf[]		= array('font', $family, $fontfile, strlen(trim($style)) ? strtolower(trim($style)) : '');
			$this->templateVariableContainer->add('tcpdf', $tcpdf);
		}
	}
}

?>
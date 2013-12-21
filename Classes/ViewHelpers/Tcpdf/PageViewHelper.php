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
 * Starts a new page
 *
 * = Examples =
 *
 * <code title="New page">
 * <odl:tcpdf.page />
 * </code>
 * <output>
 * Starts a new label page. Any following output commands will target the new page.
 * </output>
 * 
 * <code title="New page (enclosing it's content)">
 * <odl:tcpdf.page> ... </odl:tcpdf.page>
 * </code>
 * <output>
 * This does exactly the same as the first approach. The only difference is that the viewhelper element encloses the page's content, which may result in a somewhat more semantic fluid template. The two approaches can even be mixed.
 * </output>
 *
 * @api
 */
class PageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Start a new page
	 * 
	 * @return void
	 */
	public function render() {
		try {
			$tcpdf			= (array)$this->templateVariableContainer->get('tcpdf');
			$this->templateVariableContainer->remove('tcpdf');
		} catch (\TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException $e) {
			$tcpdf			= array();
		}
		$tcpdf[]			= array('page');
		$this->templateVariableContainer->add('tcpdf', $tcpdf);
		$this->renderChildren();
	}
}

?>
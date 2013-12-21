<?php

namespace Tollwerk\TwOdl\ViewHelpers\Wallpaper;

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
 * Checks if a device wallpaper exists
 *
 * = Examples =
 *
 * <code title="Wallpaper check">
 * <odl:wallpaper.exists directory="{settings.wallpaperRootPath}" identifier="ODL-123"/>
 * </code>
 * <output>
 * Returns 1 if the wallpaper already exists, 0 otherwise
 * </output>
 * 
 * @api
 */
class ExistsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Checks if a device wallpaper exists
	 * 
	 * @param string $directory				Wallpaper root path
	 * @param string $identifier			Device identifier
	 * @return string
	 */
	public function render($directory, $identifier) {
		return @file_exists(PATH_site.trim($directory, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$identifier.'.jpg') * 1;
	}
}

?>
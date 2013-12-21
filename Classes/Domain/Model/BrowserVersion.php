<?php

namespace Tollwerk\TwOdl\Domain\Model;

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
 * Web browser version
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class BrowserVersion extends AbstractArrayable {
	/**
	 * Serializable properties
	 *
	 * @var array
	 */
	protected $_serializeProperties = array('version');
	
	/**
	 * Version string
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $version;

	/**
	 * Returns the version
	 *
	 * @return \string $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Sets the version
	 *
	 * @param \string $version
	 * @return void
	 */
	public function setVersion($version) {
		$this->version = $version;
	}
}

?>
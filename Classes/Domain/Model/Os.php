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
 * Operating system
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Os extends AbstractArrayable {
	/**
	 * Serializable properties
	 *
	 * @var array
	 */
	protected $_serializeProperties = array('name');
	
	/**
	 * Name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Versions
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\OsVersion>
	 * @lazy
	 */
	protected $versions;

	/**
	 * __construct
	 *
	 * @return Os
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->versions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Adds a OsVersion
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\OsVersion $version
	 * @return void
	 */
	public function addVersion(\Tollwerk\TwOdl\Domain\Model\OsVersion $version) {
		$this->versions->attach($version);
	}

	/**
	 * Removes a OsVersion
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\OsVersion $versionToRemove The OsVersion to be removed
	 * @return void
	 */
	public function removeVersion(\Tollwerk\TwOdl\Domain\Model\OsVersion $versionToRemove) {
		$this->versions->detach($versionToRemove);
	}

	/**
	 * Returns the versions
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\OsVersion> $versions
	 */
	public function getVersions() {
		return $this->versions;
	}

	/**
	 * Sets the versions
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\OsVersion> $versions
	 * @return void
	 */
	public function setVersions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $versions) {
		$this->versions = $versions;
	}
}

?>
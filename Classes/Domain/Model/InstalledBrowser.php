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
 * Installed web browser
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class InstalledBrowser extends AbstractArrayable {
	/**
	 * Serializable properties
	 *
	 * @var array
	 */
	protected $_serializeProperties = array('browser', 'version', 'useragent', 'features', 'debuggers');
	
	/**
	 * Device
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\Device
	 */
	protected $device;
	
	/**
	 * Browser
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\Browser
	 */
	protected $browser;

	/**
	 * Version
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\BrowserVersion
	 */
	protected $version;
	
	/**
	 * User agent string
	 *
	 * @var \string
	 */
	protected $useragent;
	
	/**
	 * Features
	 *
	 * @var \integer
	 */
	protected $features;
	
	/**
	 * debuggers
	 *
	 * @var \integer
	 */
	protected $debuggers;

	/**
	 * Returns the browser
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\Browser $browser
	 */
	public function getBrowser() {
		return $this->browser;
	}

	/**
	 * Sets the browser
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Browser $browser
	 * @return void
	 */
	public function setBrowser($browser) {
		$this->browser = $browser;
	}

	/**
	 * Returns the version
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\BrowserVersion $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Sets the version
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\BrowserVersion $version
	 * @return void
	 */
	public function setVersion(\Tollwerk\TwOdl\Domain\Model\BrowserVersion $version) {
		$this->version = $version;
	}
	

	/**
	 * Returns the user agent string
	 * 
	 * @return string						User agent string
	 */
	public function getUseragent() {
		return $this->useragent;
	}
	
	/**
	 * Sets the user agent string
	 * 
	 * @param string $useragent				User agent string
	 * @return void
	 */
	public function setUseragent($useragent) {
		$this->useragent = $useragent;
	}

	/**
	 * Returns the features
	 *
	 * @param boolean $jsonp				JSONP export
	 * @return \array $features
	 */
	public function getFeatures($jsonp = false) {
		\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_twodl_domain_model_installedbrowser');
	
		$features			= intval($this->features);
		$featuresArray		= array();
		$bit				= 0;
		while($features != 0) {
			if (pow(2, $bit) & $features) {
				$features			&= ~pow(2, $bit);
				$featuresLabel		= explode('.', $GLOBALS['TCA']['tx_twodl_domain_model_installedbrowser']['columns']['features']['config']['items'][$bit][0]);
				$featuresArray[]	= array_pop($featuresLabel);
			}
			++$bit;
		}
		return $featuresArray;
	}
	
	/**
	 * Sets the features
	 *
	 * @param mixed $features
	 */
	public function setFeatures($features) {
		if (is_array($features)) {
			$bit			= 0;
			foreach ($features as $power) {
				$bit		|= pow(2, intval($power));
			}
			$features		= $bit;
		}
		$this->features 	= $features;
	}
	
	/**
	 * Returns the debuggers
	 *
	 * @param boolean $jsonp				JSONP export
	 * @return \array $debuggers
	 */
	public function getDebuggers($jsonp = false) {
		\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_twodl_domain_model_installedbrowser');
	
		$debuggers			= intval($this->debuggers);
		$debuggersArray		= array();
		$bit				= 0;
		while($debuggers != 0) {
			if (pow(2, $bit) & $debuggers) {
				$debuggers			&= ~pow(2, $bit);
				$debuggersLabel		= explode('.', $GLOBALS['TCA']['tx_twodl_domain_model_installedbrowser']['columns']['debuggers']['config']['items'][$bit][0]);
				$debuggersArray[]	= array_pop($debuggersLabel);
			}
			++$bit;
		}
		return $debuggersArray;
	}
	
	/**
	 * Sets the debuggers
	 *
	 * @param mixed $debuggers
	 */
	public function setDebuggers($debuggers) {
		if (is_array($debuggers)) {
			$bit			= 0;
			foreach ($debuggers as $power) {
				$bit		|= pow(2, intval($power));
			}
			$debuggers		= $bit;
		}
		$this->debuggers 	= $debuggers;
	}
	
	/**
	 * Return the device
	 * 
	 * @return \Tollwerk\TwOdl\Domain\Model\Device			Device	
	 */
	public function getDevice() {
		return $this->device;
	}

	/**
	 * Set the device
	 * 
	 * @param \Tollwerk\TwOdl\Domain\Model\Device $device	Device
	 */
	public function setDevice($device) {
		$this->device = $device;
	}
}

?>
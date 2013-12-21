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
 * ODL Device
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Device extends AbstractArrayable {
	/**
	 * Serializable properties
	 *
	 * @var array
	 */
	protected $_serializeProperties = array('manufacturer', 'name', 'model', 'os', 'osversion', 'width', 'height', 'diagonal', 'ppcm', 'ppi', 'inputmethods', 'connectivity', 'resolutions', 'browsers', 'comment', 'contributor', 'registration', 'available');
	
	/**
	 * Name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * Model name
	 *
	 * @var \string
	 */
	protected $model;

	/**
	 * Serial number
	 *
	 * @var \string
	 */
	protected $serialnumber;
	
	/**
	 * IMEI
	 *
	 * @var \string
	 */
	protected $imei;

	/**
	 * Display width
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $width;

	/**
	 * Display height
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $height;

	/**
	 * Homescreen width
	 *
	 * @var \integer
	 */
	protected $homewidth;
	
	/**
	 * Homescreen height
	 *
	 * @var \integer
	 */
	protected $homeheight;

	/**
	 * Diagonal
	 *
	 * @var \float
	 */
	protected $diagonal;

	/**
	 * Pixels per centimeter
	 *
	 * @var \integer
	 */
	protected $ppcm;

	/**
	 * Pixels per inch
	 *
	 * @var \integer
	 */
	protected $ppi;

	/**
	 * Comment
	 *
	 * @var \string
	 */
	protected $comment;

	/**
	 * Internal comment
	 *
	 * @var \string
	 */
	protected $internalcomment;

	/**
	 * Manufacturer
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\Manufacturer
	 * @lazy
	 */
	protected $manufacturer;

	/**
	 * Operating system
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\Os
	 * @lazy
	 */
	protected $os;

	/**
	 * Version
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\OsVersion
	 * @lazy
	 */
	protected $osversion;

	/**
	 * Contributor
	 *
	 * @var \Tollwerk\TwOdl\Domain\Model\Contributor
	 * @lazy
	 */
	protected $contributor;

	/**
	 * CSS display resolutions
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\Resolution>
	 * @lazy
	 */
	protected $resolutions;

	/**
	 * Installed web browsers
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\InstalledBrowser>
	 * @lazy
	 */
	protected $browsers;
	
	/**
	 * Availability
	 *
	 * @var \integer
	 */
	protected $available;

	/**
	 * Input methods
	 *
	 * @var \integer
	 */
	protected $inputmethods;
	
	/**
	 * Connectivity
	 *
	 * @var \integer
	 */
	protected $connectivity;
	
	/**
	 * Registration
	 *
	 * @var \DateTime
	 */
	protected $registration;
	
	/**
	 * __construct
	 *
	 * @return Device
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->resolutions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->browsers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the model
	 *
	 * @return \string $model
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * Sets the model
	 *
	 * @param \string $model
	 * @return void
	 */
	public function setModel($model) {
		$this->model = $model;
	}

	/**
	 * Returns the serialnumber
	 *
	 * @return \string $serialnumber
	 */
	public function getSerialnumber() {
		return $this->serialnumber;
	}

	/**
	 * Sets the serialnumber
	 *
	 * @param \string $serialnumber
	 * @return void
	 */
	public function setSerialnumber($serialnumber) {
		$this->serialnumber = $serialnumber;
	}
	
	/**
	 * Returns the width
	 *
	 * @return \integer $width
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Sets the width
	 *
	 * @param \integer $width
	 * @return void
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * Returns the height
	 *
	 * @return \integer $height
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Sets the height
	 *
	 * @param \integer $height
	 * @return void
	 */
	public function setHeight($height) {
		$this->height = $height;
	}
	
	/**
	 * Returns the homescreen width
	 *
	 * @return \integer $homewidth
	 */
	public function getHomewidth() {
		return max(intval($this->homewidth), $this->width);
	}
	
	/**
	 * Sets the homescreen width
	 *
	 * @param \integer $homewidth
	 * @return void
	 */
	public function setHomewidth($homewidth) {
		$this->homewidth = $homewidth;
	}
	
	/**
	 * Returns the homescreen height
	 *
	 * @return \integer $homeheight
	 */
	public function getHomeheight() {
		return max(intval($this->homeheight), $this->height);
	}
	
	/**
	 * Sets the homescreen height
	 *
	 * @param \integer $homeheight
	 * @return void
	 */
	public function setHomeheight($homeheight) {
		$this->homeheight = $homeheight;
	}

	/**
	 * Returns the diagonal
	 *
	 * @return \float $diagonal
	 */
	public function getDiagonal() {
		return $this->diagonal;
	}

	/**
	 * Sets the diagonal
	 *
	 * @param \float $diagonal
	 * @return void
	 */
	public function setDiagonal($diagonal) {
		$this->diagonal = $diagonal;
	}

	/**
	 * Returns the ppcm
	 *
	 * @return \integer $ppcm
	 */
	public function getPpcm() {
		return $this->ppcm;
	}

	/**
	 * Sets the ppcm
	 *
	 * @param \integer $ppcm
	 * @return void
	 */
	public function setPpcm($ppcm) {
		$this->ppcm = $ppcm;
	}

	/**
	 * Returns the ppi
	 *
	 * @return \integer $ppi
	 */
	public function getPpi() {
		return $this->ppi;
	}

	/**
	 * Sets the ppi
	 *
	 * @param \integer $ppi
	 * @return void
	 */
	public function setPpi($ppi) {
		$this->ppi = $ppi;
	}

	/**
	 * Returns the comment
	 *
	 * @return \string $comment
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Sets the comment
	 *
	 * @param \string $comment
	 * @return void
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * Returns the internalcomment
	 *
	 * @return \string $internalcomment
	 */
	public function getInternalcomment() {
		return $this->internalcomment;
	}

	/**
	 * Sets the internalcomment
	 *
	 * @param \string $internalcomment
	 * @return void
	 */
	public function setInternalcomment($internalcomment) {
		$this->internalcomment = $internalcomment;
	}

	/**
	 * Returns the manufacturer
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\Manufacturer $manufacturer
	 */
	public function getManufacturer() {
		return $this->manufacturer;
	}

	/**
	 * Sets the manufacturer
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Manufacturer $manufacturer
	 * @return void
	 */
	public function setManufacturer(\Tollwerk\TwOdl\Domain\Model\Manufacturer $manufacturer) {
		$this->manufacturer = $manufacturer;
	}

	/**
	 * Returns the os
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\Os $os
	 */
	public function getOs() {
		return $this->os;
	}

	/**
	 * Sets the os
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Os $os
	 * @return void
	 */
	public function setOs(\Tollwerk\TwOdl\Domain\Model\Os $os) {
		$this->os = $os;
	}

	/**
	 * Returns the osversion
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\OsVersion $osversion
	 */
	public function getOsversion() {
		return $this->osversion;
	}

	/**
	 * Sets the osversion
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\OsVersion $osversion
	 * @return void
	 */
	public function setOsversion(\Tollwerk\TwOdl\Domain\Model\OsVersion $osversion) {
		$this->osversion = $osversion;
	}

	/**
	 * Returns the contributor
	 *
	 * @return \Tollwerk\TwOdl\Domain\Model\Contributor $contributor
	 */
	public function getContributor() {
		return $this->contributor;
	}

	/**
	 * Sets the contributor
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Contributor $contributor
	 * @return void
	 */
	public function setContributor(\Tollwerk\TwOdl\Domain\Model\Contributor $contributor) {
		$this->contributor = $contributor;
	}

	/**
	 * Adds a Resolution
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Resolution $resolution
	 * @return void
	 */
	public function addResolution(\Tollwerk\TwOdl\Domain\Model\Resolution $resolution) {
		$this->resolutions->attach($resolution);
	}

	/**
	 * Removes a Resolution
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\Resolution $resolutionToRemove The Resolution to be removed
	 * @return void
	 */
	public function removeResolution(\Tollwerk\TwOdl\Domain\Model\Resolution $resolutionToRemove) {
		$this->resolutions->detach($resolutionToRemove);
	}

	/**
	 * Returns the resolutions
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\Resolution> $resolutions
	 */
	public function getResolutions() {
		return $this->resolutions;
	}

	/**
	 * Sets the resolutions
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\Resolution> $resolutions
	 * @return void
	 */
	public function setResolutions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $resolutions) {
		$this->resolutions = $resolutions;
	}

	/**
	 * Adds an installed Browser
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\InstalledBrowser $browser
	 * @return void
	 */
	public function addBrowser(\Tollwerk\TwOdl\Domain\Model\InstalledBrowser $browser) {
		$this->browsers->attach($browser);
	}

	/**
	 * Removes an installed Browser
	 *
	 * @param \Tollwerk\TwOdl\Domain\Model\InstalledBrowser $browserToRemove The Browser to be removed
	 * @return void
	 */
	public function removeBrowser(\Tollwerk\TwOdl\Domain\Model\InstalledBrowser $browserToRemove) {
		$this->browsers->detach($browserToRemove);
	}

	/**
	 * Returns the browsers
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\InstalledBrowser> $browsers
	 */
	public function getBrowsers() {
		return $this->browsers;
	}

	/**
	 * Sets the browsers
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Tollwerk\TwOdl\Domain\Model\InstalledBrowser> $browsers
	 * @return void
	 */
	public function setBrowsers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $browsers) {
		$this->browsers = $browsers;
	}

	/**
	 * Returns the availability
	 *
	 * @return \integer $available
	 */
	public function getAvailable() {
		return $this->available;
	}
	
	/**
	 * Sets the availability
	 *
	 * @param \integer $available
	 * @return void
	 */
	public function setAvailable($available) {
		$this->available = $available;
	}
	
	/**
	 * Returns the imei
	 * 
	 * @return \string $imei
	 */
	public function getImei() {
		return $this->imei;
	}
	
	/**
	 * Sets the imei
	 * 
	 * @param \string $imei
	 */
	public function setImei($imei) {
		$this->imei = $imei;
	}

	/**
	 * Returns the inputmethods
	 * 
	 * @param boolean $jsonp				JSONP export
	 * @return \array $inputmethods
	 */
	public function getInputmethods($jsonp = false) {
		\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_twodl_domain_model_device');
		
		$inputmethods		= intval($this->inputmethods);
		$inputmethodsArray	= array();
		$bit				= 0;
		while($inputmethods != 0) {
			if (pow(2, $bit) & $inputmethods) {
				$inputmethods			&= ~pow(2, $bit);
				$inputmethodLabel		= explode('.', $GLOBALS['TCA']['tx_twodl_domain_model_device']['columns']['inputmethods']['config']['items'][$bit][0]);
				$inputmethodsArray[]	= array_pop($inputmethodLabel);
			}
			++$bit;
		}
		return $inputmethodsArray;
	}

	/**
	 * Sets the inputmethods
	 * 
	 * @param mixed $inputmethods
	 */
	public function setInputmethods($inputmethods) {
		if (is_array($inputmethods)) {
			$bit			= 0;
			foreach ($inputmethods as $power) {
				$bit		|= pow(2, intval($power));
			}
			$inputmethods	= $bit;
		}
		$this->inputmethods = $inputmethods;
	}
	
	/**
	 * Returns the connectivity
	 *
	 * @param boolean $jsonp				JSONP export
	 * @return \array $connectivity
	 */
	public function getConnectivity($jsonp = false) {
		\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_twodl_domain_model_device');
	
		$connectivity		= intval($this->connectivity);
		$connectivityArray	= array();
		$bit				= 0;
		while($connectivity != 0) {
			if (pow(2, $bit) & $connectivity) {
				$connectivity			&= ~pow(2, $bit);
				$connectivityLabel		= explode('.', $GLOBALS['TCA']['tx_twodl_domain_model_device']['columns']['connectivity']['config']['items'][$bit][0]);
				$connectivityArray[]	= array_pop($connectivityLabel);
			}
			++$bit;
		}
		return $connectivityArray;
	}
	
	/**
	 * Sets the connectivity
	 *
	 * @param mixed $connectivity
	 */
	public function setConnectivity($connectivity) {
		if (is_array($connectivity)) {
			$bit			= 0;
			foreach ($connectivity as $power) {
				$bit		|= pow(2, intval($power));
			}
			$connectivity	= $bit;
		}
		$this->connectivity = $connectivity;
	}
	
	
	/**
	 * Returns the registration
	 * 
	 * @param boolean $jsonp				JSONP export
	 * @return \DateTime $registration
	 */
	public function getRegistration($jsonp = false) {
		return $jsonp ? $this->registration->format('c') : $this->registration;
	}

	/**
	 * Sets the registration
	 * 
	 * @param \DateTime $registration
	 */
	public function setRegistration($registration) {
		$this->registration = $registration;
	}
}

?>
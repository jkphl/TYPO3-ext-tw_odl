<?php

namespace Tollwerk\TwOdl\Controller;

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
 * Device controller
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DeviceController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * Device repository
	 *
	 * @var \Tollwerk\TwOdl\Domain\Repository\DeviceRepository
	 */
	protected $deviceRepository;
	
	/**
	 * Installed browser repository
	 *
	 * @var \Tollwerk\TwOdl\Domain\Repository\InstalledBrowserRepository
	 */
	protected $installedBrowserRepository;
	
	/**
	 * Inject device repository
	 *
	 * @param \Tollwerk\TwOdl\Domain\Repository\DeviceRepository $deviceRepository
	 * @return void
	 */
	public function injectDeviceRepository(\Tollwerk\TwOdl\Domain\Repository\DeviceRepository $deviceRepository) {
		$this->deviceRepository = $deviceRepository;
	}
	
	/**
	 * Inject installed browser repository
	 *
	 * @param \Tollwerk\TwOdl\Domain\Repository\InstalledBrowserRepository $installedBrowserRepository
	 * @return void
	 */
	public function injectInstalledBrowserRepository(\Tollwerk\TwOdl\Domain\Repository\InstalledBrowserRepository $installedBrowserRepository) {
		$this->installedBrowserRepository = $installedBrowserRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$devices = $this->deviceRepository->findAll();
		$this->view->assign('devices', $devices);
	}

	/**
	 * Return a complete device list as JSON file
	 * 
	 * @return string				JSON(P) device directory
	 */
	public function jsonpAction() {
		$devices				= array();
		
		/* @var $device \Tollwerk\TwOdl\Domain\Model\Device */
		foreach ($this->deviceRepository->findAll() as $device) {
			$devices[]			= $device->toArray();
		}
		
		$json					= @json_encode($devices);
		$callback				= trim(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('callback'));
		$callback				= strlen($callback) ? $callback : trim(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('jsonp'));
		
		// If it's a JSONP call
		if (strlen($callback)) {
			$json				= $callback.'('.$json.');';
			$contentType		= 'application/javascript';
			
		// Else
		} else {
			$contentType		= 'application/json';
		}
		
		ob_end_clean();
		header('Content-Type: '.$contentType);
		die($json);
	}
	
	/**
	 * Device user agent registration
	 * 
	 * @param \Tollwerk\TwOdl\Domain\Model\Device $device							Device
	 * @param \Tollwerk\TwOdl\Domain\Model\InstalledBrowser $installedbrowser		Installed browser
	 * @param boolean $register														Register user agent string
	 * @param boolean $unregister													Unregister user agent string of selected browser
	 * @return void
	 */
	public function useragentAction(\Tollwerk\TwOdl\Domain\Model\Device $device = null, \Tollwerk\TwOdl\Domain\Model\InstalledBrowser $installedbrowser = null, $register = false, $unregister = false) {
		$userAgent								= trim($_SERVER['HTTP_USER_AGENT']);
		$registered								=
		$unregistered							= false;
		
		// If a user agent string should be registered
		if (strlen($userAgent) && ($installedbrowser instanceof \Tollwerk\TwOdl\Domain\Model\InstalledBrowser)) {
			if ($register) {
				$installedbrowser->setUseragent($userAgent);
				$registered						= true;
			} elseif ($unregister) {
				$installedbrowser->setUseragent('');
				$unregistered					= true;
			}
		}
		
		$this->view->assign('device', $device);
		$this->view->assign('installedbrowser', $installedbrowser);
		$this->view->assign('useragent', $userAgent);
		$this->view->assign('registered', $registered);
		$this->view->assign('unregistered', $unregistered);
	}
	
	/**
	 * Return a barcode image identifying the current device and browser
	 * 
	 * @return void
	 */
	public function barcodeAction() {
		require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('tw_odl', 'Resources'.DIRECTORY_SEPARATOR.'Private'.DIRECTORY_SEPARATOR.'Tcpdf'.DIRECTORY_SEPARATOR.'tcpdf_barcodes_1d.php');
		$userAgent								= empty($_SERVER['HTTP_USER_AGENT']) ? null : trim($_SERVER['HTTP_USER_AGENT']);
		$barcodeString							= 'Invalid user agent';
		if (strlen($userAgent)) {
			$installedBrowsers					= $this->installedBrowserRepository->findByUserAgent($userAgent);
			if (count($installedBrowsers)) {
				/* @var $installedBrowser \Tollwerk\TwOdl\Domain\Model\InstalledBrowser */
				$installedBrowser				= $installedBrowsers->current();
				
				/* @var $device \Tollwerk\TwOdl\Domain\Model\Device */
				$device							= $installedBrowser->getDevice();
				$barcodeString					= implode("\t", array(
					$device->getOs()->getName(),
					$device->getOsversion()->getVersion(),
					$installedBrowser->getBrowser()->getName(),
					$installedBrowser->getVersion()->getVersion(),					
				));
			}
		}
		
		header('Content-Type: image/png');
		$userAgentBarcode						= new \TCPDFBarcode($barcodeString, 'C128');
		$userAgentBarcode->getBarcodePNG(1, 1);
		exit;
	}
}

?>
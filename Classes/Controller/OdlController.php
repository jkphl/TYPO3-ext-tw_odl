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
 * ODL backend module controller
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class OdlController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	
	/**
	 * Device repository
	 *
	 * @var \Tollwerk\TwOdl\Domain\Repository\DeviceRepository
	 */
	protected $deviceRepository;
	
	/**
	 * Current page ID
	 * 
	 * @var int
	 */
	protected $_pageUid = 0;
	
	/**
	 * Wallpaper configuration
	 * 
	 * @var array
	 */
	protected $_wallpaperConfig = null;
	
	/**
	 * Inject device repository
	 *
	 * @param \Tollwerk\TwOdl\Domain\Repository\DeviceRepository $deviceRepository
	 * @return void
	 */
	public function injectDeviceRepository(\Tollwerk\TwOdl\Domain\Repository\DeviceRepository $deviceRepository) {
		$this->deviceRepository 			= $deviceRepository;
	}
	
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->_pageUid						= intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id'));
	}
	
	/**
	 * Initializes the view before invoking an action method.
	 *
	 * Override this method to solve assign variables common for all actions
	 * or prepare the view in another way before the action is called.
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
	 * @return void
	 */
	protected function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		$arguments							= $this->request->getArguments();
		if (array_key_exists('template', $arguments)) {
			$extbaseFrameworkConfiguration	= $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			$labelTemplateRootPath			= \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['labelTemplateRootPath']);
			$view->setTemplatePathAndFilename($labelTemplateRootPath.$arguments['template']);
		}
	}

	/**
	 * Label print preparation
	 *
	 * @return void
	 */
	public function labelsAction() {
		$extbaseFrameworkConfiguration		= $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$labelTemplateRootPath				= \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['labelTemplateRootPath']);
		$labelTemplates						= array();
		if (@is_dir($labelTemplateRootPath)) {
			foreach (@scandir($labelTemplateRootPath) as $templateFile) {
				if (@is_file($labelTemplateRootPath.$templateFile) && (strtolower(pathinfo($templateFile, PATHINFO_EXTENSION) == 'pdf'))) {
					$labelTemplates[]		= array('label' => pathinfo($templateFile, PATHINFO_FILENAME), 'path' => $templateFile);
				}
			}
		}
		
		$this->view->assign('devices', $this->deviceRepository->findByPid($this->_pageUid));
		$this->view->assign('labelTemplates', $labelTemplates);
		$this->view->assign('pageUid', $this->_pageUid);
	}

	/**
	 * Label printing
	 * 
	 * @param \array $devices		Devices
	 * @param \integer $offset		Blank label offset
	 * @return void
	 */
	public function printAction(array $devices = array(), $offset = 0) {
		$devices							= $this->deviceRepository->findByUids($devices);
		$this->view->assign('devices', $devices);
		$this->view->assign('offset', max(0, intval($offset)));
		$this->view->assign('pageUid', $this->_pageUid);
	}
	
	/**
	 * Device wallpapers
	 * 
	 * @param \array $devices		Devices
	 * @return void
	 */
	public function wallpapersAction(array $devices = array()) {
		$this->settings['wallpaperRootPath']	= trim($this->settings['wallpaperRootPath'], '/').'/';
		
		// If wallpapers should be created
		if (count($devices)) {
			chdir(PATH_site);
			
			/* @var $typoScriptService \TYPO3\CMS\Extbase\Service\TypoScriptService */
			$typoScriptService			= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\TypoScriptService');
			$this->_wallpaperConfig		= $typoScriptService->convertPlainArrayToTypoScriptArray($this->settings['wallpaper']);
			
			if (!isset($GLOBALS['TSFE'])) {
				if (!is_object($GLOBALS['TT'])) {
					$GLOBALS['TT'] = new \TYPO3\CMS\Core\TimeTracker\TimeTracker();
					$GLOBALS['TT']->start();
				}
				
				$GLOBALS['TSFE'] = new \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController($GLOBALS['TYPO3_CONF_VARS'], $this->_pageUid, '0', 0, '', '', '', '');
				$GLOBALS['TSFE']->connectToDB();
				$GLOBALS['TSFE']->initFEuser();
				$GLOBALS['TSFE']->fetch_the_id();
				$GLOBALS['TSFE']->getPageAndRootline();
				$GLOBALS['TSFE']->initTemplate();
				$GLOBALS['TSFE']->tmpl->getFileName_backPath = PATH_site;
				$GLOBALS['TSFE']->forceTemplateParsing = 1;
				$GLOBALS['TSFE']->getConfigArray();
			}
			
			// Run through all selected devices
			foreach ($this->deviceRepository->findByUids($devices) as $device) {
				$this->_createWallpaper($device);
			}
		}
		
		$this->view->assign('settings', $this->settings);
		$this->view->assign('devices', $this->deviceRepository->findByPid($this->_pageUid));
	}
	
	/************************************************************************************************
	 * PRIVATE METHODS
	 ***********************************************************************************************/
	
	/**
	 * Create or recreate a device wallpaper
	 * 
	 * @param \Tollwerk\TwOdl\Domain\Model\Device $device		Device
	 * @return void
	 */
	protected function _createWallpaper(\Tollwerk\TwOdl\Domain\Model\Device $device) {
		$paddedDeviceNumber					= str_pad($device->getUid(), $this->settings['deviceNumberDigits'], '0', STR_PAD_LEFT);
		$deviceIdentifier					= sprintf($this->settings['deviceIdentifier'], $paddedDeviceNumber);
		$wallpaperPath						= PATH_site.$this->settings['wallpaperRootPath'].$deviceIdentifier.'.jpg';
		
		// If the wallpaper doesn't exist yet or can be deleted
		if (!@file_exists($wallpaperPath) || @unlink($wallpaperPath)) {
			$substitute						= array(
				'###DEVICEWIDTH###'			=> $device->getWidth(),	
				'###DEVICEHEIGHT###'		=> $device->getHeight(),
				'###DEVICEHOMEWIDTH###'		=> $device->getHomewidth(),
				'###DEVICEHOMEHEIGHT###'	=> $device->getHomeheight(),
				'###DEVICEPPCM###'			=> $device->getPpcm(),
				'###DEVICEPPI###'			=> $device->getPpi(),
				'###DEVICENUMBER###'		=> $paddedDeviceNumber,
				'###DEVICEIDENTIFIER###'	=> $deviceIdentifier,
			);
			$wallpaperConfig				= $this->_deriveDeviceWallpaperConfig($this->_wallpaperConfig, $substitute);
			$wallpaperConfig['XY']			= $device->getHomewidth().','.$device->getHomeheight();
			$wallpaperConfig['format']		= 'jpg';
			$wallpaperConfig['maxWidth']	= $device->getHomewidth();
			$wallpaperConfig['maxHeight']	= $device->getHomeheight();
			$wallpaper						= $this->configurationManager->getContentObject()->IMG_RESOURCE(array('file' => 'GIFBUILDER', 'file.' => $wallpaperConfig));
			if ($wallpaper && @is_file(PATH_site.$wallpaper)) {
				rename(PATH_site.$wallpaper, $wallpaperPath);
			}
		}
	}

	/**
	 * Derive a wallpaper configuration for a specific device (substituting e.g. device width & height)
	 * 
	 * @param array $config										Wallpaper configuration
	 * @param array $substitute									Substitution markers
	 * @return array											Derived configuration
	 */
	protected function _deriveDeviceWallpaperConfig(array $config, array $substitute) {
		foreach ($config as $key => $value) {
			if (is_array($value)) {
				$config[$key]				=  $this->_deriveDeviceWallpaperConfig($value, $substitute);
			} else {
				$config[$key]				= strtr($value, $substitute);
				if ($key = 'fontFile') {
					$config[$key]			= \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($config[$key]);
				}
			}
		}
		return $config;
	}
}
?>
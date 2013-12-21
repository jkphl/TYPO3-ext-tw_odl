<?php

namespace Tollwerk\TwOdl\Utility;

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
 * New content element wizard icon and description
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Wizicon {
	
	/**
	 * Main method
	 * 
	 * @param array $wizardItems				Wizard items
	 * @return array							Extended wizard items
	 */
	function proc($wizardItems)	{
		$LL												= $this->includeLocalLang();
		$wizardItems['plugins_twodl_device']			= array(
			'icon'										=> \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_odl').'/Resources/Public/Icons/Wizicon.png',
			'title'										=> $GLOBALS['LANG']->getLLL('wizicon.device.title', $LL),
			'description'								=> $GLOBALS['LANG']->getLLL('wizicon.device.description', $LL),
			'params'									=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=twodl_device'
		);
		$wizardItems['plugins_twodl_useragent']			= array(
			'icon'										=> \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tw_odl').'/Resources/Public/Icons/Wizicon.png',
			'title'										=> $GLOBALS['LANG']->getLLL('wizicon.useragent.title', $LL),
			'description'								=> $GLOBALS['LANG']->getLLL('wizicon.useragent.description', $LL),
			'params'									=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=twodl_useragent'
		);
		return $wizardItems;
	}

	/**
	 * Includes the language file and returns the found language labels
	 *
	 * @return array							Language labels
	 */
	function includeLocalLang()	{
		/* @var $parserFactory t3lib_l10n_Factory */
		$parserFactory									= \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_l10n_Factory');
		return $parserFactory->getParsedData(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('tw_odl', 'Resources'.DIRECTORY_SEPARATOR.'Private'.DIRECTORY_SEPARATOR.'Language'.DIRECTORY_SEPARATOR.'locallang.xlf'), $GLOBALS['LANG']->lang, 'utf-8', 1);
	}
}

if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/tw_odl/Classes/Utility/Wizicon.php']) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/tw_odl/Classes/Utility/Wizicon.php']);
};
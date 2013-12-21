<?php

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

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (!@class_exists('user_odl', false)) {
	/**
	 * Helper class for user defined functions
	 */
	class user_odl {
		/**
		 * Generate the device title (used by the backend when listing records)
		 *
		 * @param array $params					Label parameters
		 * @param array $pObj					Parent object
		 * @return void
		 */
		function getDeviceTitle(&$params, &$pObj) {
			$params['title']			= \TYPO3\CMS\Backend\Utility\BackendUtility::getRecordTitle('tx_twodl_domain_model_manufacturer', \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tx_twodl_domain_model_manufacturer', $params['row']['manufacturer'])).' '.$params['row']['name'];
		}
		
		/**
		 * Generate the resolution title (used by the backend when listing records)
		 *
		 * @param array $params					Label parameters
		 * @param array $pObj					Parent object
		 * @return void
		 */
		function getResolutionTitle(&$params, &$pObj) {
			$params['title']			= intval($params['row']['width']).' x '.intval($params['row']['height']);
			if (floatval($params['row']['ratio']) != 1) {
				$params['title']		.= ' @ '.round(floatval($params['row']['ratio']), 4).'x';
			}
			if (intval($params['row']['orientation']) != 3) {
				$params['title']		.= $GLOBALS['LANG']->sL('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.orientation.title.'.intval($params['row']['orientation']));
			}
		}
	}
}

// Register the backend module: Avoid that this block is loaded in the frontend or within the upgrade-wizards
if ((TYPO3_MODE == 'BE') && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {

	// Registers a Backend Module
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Tollwerk.'.$_EXTKEY,
		'web',
		'odl',
		'',
		array(
			'Odl' => 'labels,print,wallpapers',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:'.$_EXTKEY.'/Resources/Public/Icons/odl.png',
			'labels' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_odl.xml',
		)
	);
}

// Device list plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Device',
	'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tt_content.list_type.device'
);

// Device user agent registration plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Useragent',
	'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tt_content.list_type.useragent'
);

// Wizard entries
if (TYPO3_MODE=='BE')	{
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['Tollwerk\\TwOdl\\Utility\\Wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Classes'.DIRECTORY_SEPARATOR.'Utility'.DIRECTORY_SEPARATOR.'Wizicon.php');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'tollwerk Open Device Lab');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_manufacturer');
$TCA['tx_twodl_domain_model_manufacturer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_manufacturer',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Manufacturer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png',
			
		'default_sortby' => 'ORDER BY name ASC',
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_os');
$TCA['tx_twodl_domain_model_os'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_os',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,versions,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Os.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png',
			
		'default_sortby' => 'ORDER BY name ASC',
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_osversion');
$TCA['tx_twodl_domain_model_osversion'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_osversion',
		'label' => 'version',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'version,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/OsVersion.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png',
			
		'default_sortby' => 'ORDER BY version ASC',
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_device');
$TCA['tx_twodl_domain_model_device'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device',
		'label' => 'name',
		'label_alt' => 'manufacturer',
		'label_alt_force' => true,
		'label_userFunc' => 'user_odl->getDeviceTitle',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'requestUpdate' => 'os',
		'searchFields' => 'name,model,serialnumber,imei,available,width,height,homewidth,homeheight,diagonal,ppcm,ppi,comment,internalcomment,manufacturer,os,osversion,contributor,resolutions,browsers,registration,inputmethods',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Device.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_contributor');
$TCA['tx_twodl_domain_model_contributor'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_contributor',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,logo,url,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Contributor.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png',
			
		'default_sortby' => 'ORDER BY name ASC',
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_resolution');
$TCA['tx_twodl_domain_model_resolution'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution',
		'label' => 'width',
		'label_alt' => 'height,ratio,orientation',
		'label_alt_force' => true,
 		'label_userFunc' => 'user_odl->getResolutionTitle',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'width,height,ratio,orientation,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Resolution.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_browserversion');
$TCA['tx_twodl_domain_model_browserversion'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_browserversion',
		'label' => 'version',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'version,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/BrowserVersion.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png',
			
		'default_sortby' => 'ORDER BY version ASC',
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_browser');
$TCA['tx_twodl_domain_model_browser'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_browser',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,version,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Browser.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_twodl_domain_model_installedbrowser');
$TCA['tx_twodl_domain_model_installedbrowser'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser',
		'label' => 'browser',
		'label_alt' => 'version',
		'label_alt_force' => true,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'requestUpdate' => 'browser',
		'searchFields' => 'name,version,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/InstalledBrowser.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/odl.png'
	),
);

?>
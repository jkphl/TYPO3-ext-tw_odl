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

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_twodl_domain_model_installedbrowser'] = array(
	'ctrl' => $TCA['tx_twodl_domain_model_installedbrowser']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, browser, version, features, debuggers',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.palette.browser;browser,useragent,features,debuggers,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,hidden;;1, starttime, endtime'),
	),
	'palettes' => array(
		'browser' => array('showitem' => 'browser,version', 'canNotCollapse' => 1),
	),
	'columns' => array(
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'browser' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.browser',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_browser',
				'foreign_table_where' => 'ORDER BY tx_twodl_domain_model_browser.name ASC',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.select', 0)
				),
				'wizards' => array(
					'_PADDING' => 2,
					'_VERTICAL' => 0,
					'add' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_browser.wizards.add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_twodl_domain_model_browser',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'set'
						),
						'script' => 'wizard_add.php',
					),
				)
			),
		),
		'version' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.version',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_browserversion',
				'foreign_table_where' => 'AND tx_twodl_domain_model_browserversion.browser = ###REC_FIELD_browser### ORDER BY tx_twodl_domain_model_browserversion.version ASC',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.notavailable', 0)
				),
			),
		),
		'device' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'features' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.features',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.features.mediaqueries', 0),
				),
			),
		),
		'debuggers' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.debuggers',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.debuggers.edgeinspect', 0),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.debuggers.ghostlab', 1),
				),
			),
		),
		'useragent' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_installedbrowser.useragent',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			),
		),
	),
);

?>
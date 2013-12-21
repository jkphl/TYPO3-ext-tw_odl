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

$TCA['tx_twodl_domain_model_device'] = array(
	'ctrl' => $TCA['tx_twodl_domain_model_device']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, model, serialnumber, imei, available, inputmethods, connectivity, width, height, homewidth, homeheight, diagonal, ppcm, ppi, comment, internalcomment, manufacturer, os, osversion, --palette--;;contrib, resolutions, browsers',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;;name, --palette--;;serial, --palette--;;contrib, available, --div--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.tab.characteristics,--palette--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.palette.os;os,inputmethods,connectivity,--palette--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.palette.display;display,--palette--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.palette.homescreen;homescreen,tx_twodl_domain_model_device.palette.display, resolutions, browsers,--div--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.tab.comments, sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, comment, internalcomment,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,hidden, starttime, endtime'),
	),
	'palettes' => array(
		'os' => array('showitem' => 'os,osversion', 'canNotCollapse' => 1),
		'name' => array('showitem' => 'manufacturer,name,model', 'canNotCollapse' => 1),
		'serial' => array('showitem' => 'serialnumber,imei', 'canNotCollapse' => 1),
		'display' => array('showitem' => 'width,height,diagonal,ppcm,ppi', 'canNotCollapse' => 1),
		'homescreen' => array('showitem' => 'homewidth,homeheight', 'canNotCollapse' => 1),
		'contrib' => array('showitem' => 'contributor,registration', 'canNotCollapse' => 1),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_twodl_domain_model_device',
				'foreign_table_where' => 'AND tx_twodl_domain_model_device.pid=###CURRENT_PID### AND tx_twodl_domain_model_device.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
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
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
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
			'l10n_mode' => 'exclude',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.name',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required'
			),
		),
		'model' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.model',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'serialnumber' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.serialnumber',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			),
		),
		'imei' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.imei',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			),
		),
		'width' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'height' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'homewidth' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'homeheight' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'diagonal' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.diagonal',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2,required'
			),
		),
		'ppcm' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.ppcm',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'ppi' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.ppi',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'comment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.comment',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'internalcomment' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.internalcomment',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'manufacturer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.manufacturer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_manufacturer',
				'foreign_table_where' => 'ORDER BY tx_twodl_domain_model_manufacturer.name ASC',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'os' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.os',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_os',
				'foreign_table_where' => 'ORDER BY tx_twodl_domain_model_os.name ASC',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.notavailable', 0)
				),
				'wizards' => array(
					'_PADDING' => 2,
					'_VERTICAL' => 0,
					'add' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_os.wizards.add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_twodl_domain_model_os',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'set'
						),
						'script' => 'wizard_add.php',
					),
				)
			),
		),
		'osversion' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.osversion',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_osversion',
				'foreign_table_where' => 'AND tx_twodl_domain_model_osversion.os = ###REC_FIELD_os### ORDER BY tx_twodl_domain_model_osversion.version ASC',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.notavailable', 0)
				),
			),
		),
		'contributor' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.contributor',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_twodl_domain_model_contributor',
				'foreign_table_where' => 'ORDER BY tx_twodl_domain_model_contributor.name ASC',
				'minitems' => 1,
				'maxitems' => 1,
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.notavailable', 0)
				),
				'wizards' => array(
					'_PADDING' => 2,
					'_VERTICAL' => 0,
					'add' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_contributor.wizards.add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_twodl_domain_model_contributor',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'set'
						),
						'script' => 'wizard_add.php',
					),
				)
			),
		),
		'resolutions' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.resolutions',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_twodl_domain_model_resolution',
				'foreign_field' => 'device',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'browsers' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.browsers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_twodl_domain_model_installedbrowser',
				'foreign_field' => 'device',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'available' => array(
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.available',
			'config' => array(
				'type' => 'radio',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.available.permanent', 0),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.available.demand', 1),
				),
				'default' => 0,
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'registration' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.registration',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'max' => 10,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => time(),
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'inputmethods' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.touchscreen', 0),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.mouse', 1),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.keyboard', 2),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.touchpad', 3),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.penstylus', 4),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.trackball', 5),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.joystick', 6),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.pointingstick', 7),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.opticaljoystick', 8),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.inputmethods.trackwheel', 9),
				),
			),
		),
		'connectivity' => array(
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.wifi', 0),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.mobiletelephony', 1),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.mobiledata', 2),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.gps', 3),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.bluetooth', 4),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.infrared', 5),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_device.connectivity.nfc', 6),
				),
			),
		),
	),
);

?>
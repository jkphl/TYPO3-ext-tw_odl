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

$TCA['tx_twodl_domain_model_resolution'] = array(
	'ctrl' => $TCA['tx_twodl_domain_model_resolution']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, width, height, ratio, orientation',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.palette.display;display,orientation,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,hidden, starttime, endtime'),
	),
	'palettes' => array(
		'display' => array('showitem' => 'width,height,ratio', 'canNotCollapse' => 1),
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
		'width' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.width',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'height' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.height',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'ratio' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.ratio',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'default' => 1.0,
				'eval' => 'double2,required'
			),
		),
		'orientation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.orientation',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.orientation.portrait', ''),
					array('LLL:EXT:tw_odl/Resources/Private/Language/locallang_db.xlf:tx_twodl_domain_model_resolution.orientation.landscape', ''),
				),
			),
		),
		'device' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

?>
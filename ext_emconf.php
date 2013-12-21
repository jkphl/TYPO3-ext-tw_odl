<?php

########################################################################
# Extension Manager/Repository config file for ext "tw_odl".
#
# Auto generated 04-06-2013 19:14
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'tollwerk Open Device Lab',
	'description' => '[TYPO3 CMS 6 Release] Device management for Open Device Lab websites including a backend module for device label printing (via TCPDF), wallpaper image generation and a public JSONP API (extbase/fluid)',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.2.0',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => 'typo3temp/tcpdf-fonts,typo3temp/odl-wallpapers',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Joschi Kuphal',
	'author_email' => 'joschi@tollwerk.de',
	'author_company' => 'tollwerk® GmbH',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'extbase' => '6.0',
			'fluid' => '6.0',
			'typo3' => '6.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:172:{s:12:"ext_icon.gif";s:4:"9089";s:17:"ext_localconf.php";s:4:"7cc1";s:14:"ext_tables.php";s:4:"65d6";s:14:"ext_tables.sql";s:4:"0d48";s:39:"Classes/Controller/DeviceController.php";s:4:"3b8c";s:36:"Classes/Controller/OdlController.php";s:4:"3c8f";s:42:"Classes/Domain/Model/AbstractArrayable.php";s:4:"83d5";s:32:"Classes/Domain/Model/Browser.php";s:4:"0162";s:39:"Classes/Domain/Model/BrowserVersion.php";s:4:"4276";s:36:"Classes/Domain/Model/Contributor.php";s:4:"c56e";s:31:"Classes/Domain/Model/Device.php";s:4:"72bd";s:41:"Classes/Domain/Model/Installedbrowser.php";s:4:"7e00";s:37:"Classes/Domain/Model/Manufacturer.php";s:4:"8f09";s:27:"Classes/Domain/Model/Os.php";s:4:"97a3";s:34:"Classes/Domain/Model/OsVersion.php";s:4:"40f5";s:35:"Classes/Domain/Model/Resolution.php";s:4:"b90a";s:46:"Classes/Domain/Repository/DeviceRepository.php";s:4:"f504";s:49:"Classes/Domain/Repository/OsVersionRepository.php";s:4:"fb45";s:27:"Classes/Utility/Wizicon.php";s:4:"450f";s:50:"Classes/ViewHelpers/DeviceIdentifierViewHelper.php";s:4:"9a8d";s:39:"Classes/ViewHelpers/TcpdfViewHelper.php";s:4:"0cd5";s:44:"Classes/ViewHelpers/Tcpdf/FontViewHelper.php";s:4:"ba7c";s:45:"Classes/ViewHelpers/Tcpdf/ImageViewHelper.php";s:4:"28b0";s:45:"Classes/ViewHelpers/Tcpdf/LabelViewHelper.php";s:4:"c56c";s:44:"Classes/ViewHelpers/Tcpdf/PageViewHelper.php";s:4:"d112";s:44:"Classes/ViewHelpers/Tcpdf/TextViewHelper.php";s:4:"a049";s:50:"Classes/ViewHelpers/Wallpaper/ExistsViewHelper.php";s:4:"4e22";s:29:"Configuration/TCA/Browser.php";s:4:"17cb";s:36:"Configuration/TCA/BrowserVersion.php";s:4:"dfc0";s:33:"Configuration/TCA/Contributor.php";s:4:"250b";s:28:"Configuration/TCA/Device.php";s:4:"7a9c";s:38:"Configuration/TCA/Installedbrowser.php";s:4:"19d8";s:34:"Configuration/TCA/Manufacturer.php";s:4:"5184";s:24:"Configuration/TCA/Os.php";s:4:"96bd";s:31:"Configuration/TCA/OsVersion.php";s:4:"4ddd";s:32:"Configuration/TCA/Resolution.php";s:4:"347c";s:38:"Configuration/TypoScript/constants.txt";s:4:"d0c1";s:34:"Configuration/TypoScript/setup.txt";s:4:"a26e";s:45:"Resources/Private/Backend/Layouts/Module.html";s:4:"29b8";s:46:"Resources/Private/Backend/Partials/Device.html";s:4:"d41d";s:67:"Resources/Private/Backend/Templates/Labels/AVERY Zweckform 3666.pdf";s:4:"c417";s:60:"Resources/Private/Backend/Templates/Labels/Endless paper.pdf";s:4:"5e0e";s:51:"Resources/Private/Backend/Templates/Odl/Labels.html";s:4:"5c2e";s:50:"Resources/Private/Backend/Templates/Odl/Print.html";s:4:"d41d";s:55:"Resources/Private/Backend/Templates/Odl/Wallpapers.html";s:4:"f634";s:52:"Resources/Private/Fonts/DroidSans/DroidSans-Bold.afm";s:4:"30f7";s:52:"Resources/Private/Fonts/DroidSans/DroidSans-Bold.php";s:4:"06bd";s:52:"Resources/Private/Fonts/DroidSans/DroidSans-Bold.ttf";s:4:"84ee";s:50:"Resources/Private/Fonts/DroidSans/DroidSans-Bold.z";s:4:"811b";s:47:"Resources/Private/Fonts/DroidSans/DroidSans.afm";s:4:"1704";s:47:"Resources/Private/Fonts/DroidSans/DroidSans.php";s:4:"c10f";s:47:"Resources/Private/Fonts/DroidSans/DroidSans.ttf";s:4:"d8c7";s:45:"Resources/Private/Fonts/DroidSans/DroidSans.z";s:4:"f522";s:45:"Resources/Private/Fonts/DroidSans/LICENSE.txt";s:4:"d273";s:43:"Resources/Private/Language/de.locallang.xlf";s:4:"9354";s:46:"Resources/Private/Language/de.locallang_db.xlf";s:4:"6bbb";s:47:"Resources/Private/Language/de.locallang_odl.xlf";s:4:"2f71";s:40:"Resources/Private/Language/locallang.xlf";s:4:"e243";s:43:"Resources/Private/Language/locallang_db.xlf";s:4:"8ec5";s:44:"Resources/Private/Language/locallang_odl.xlf";s:4:"6c31";s:37:"Resources/Private/Tcpdf/CHANGELOG.TXT";s:4:"e249";s:37:"Resources/Private/Tcpdf/composer.json";s:4:"9114";s:35:"Resources/Private/Tcpdf/LICENSE.TXT";s:4:"5c87";s:34:"Resources/Private/Tcpdf/README.TXT";s:4:"2897";s:33:"Resources/Private/Tcpdf/tcpdf.php";s:4:"a979";s:45:"Resources/Private/Tcpdf/tcpdf_barcodes_1d.php";s:4:"ad80";s:45:"Resources/Private/Tcpdf/tcpdf_barcodes_2d.php";s:4:"5790";s:40:"Resources/Private/Tcpdf/tcpdf_import.php";s:4:"5602";s:40:"Resources/Private/Tcpdf/tcpdf_parser.php";s:4:"ab26";s:47:"Resources/Private/Tcpdf/config/tcpdf_config.php";s:4:"f2f7";s:51:"Resources/Private/Tcpdf/config/tcpdf_config_alt.php";s:4:"5507";s:45:"Resources/Private/Tcpdf/config/cert/tcpdf.crt";s:4:"c137";s:45:"Resources/Private/Tcpdf/config/cert/tcpdf.fdf";s:4:"96f8";s:45:"Resources/Private/Tcpdf/config/cert/tcpdf.p12";s:4:"7e07";s:43:"Resources/Private/Tcpdf/config/lang/afr.php";s:4:"d2e3";s:43:"Resources/Private/Tcpdf/config/lang/ara.php";s:4:"88c3";s:43:"Resources/Private/Tcpdf/config/lang/aze.php";s:4:"0d94";s:43:"Resources/Private/Tcpdf/config/lang/bel.php";s:4:"aaa9";s:43:"Resources/Private/Tcpdf/config/lang/bra.php";s:4:"2b9a";s:43:"Resources/Private/Tcpdf/config/lang/bul.php";s:4:"cffa";s:43:"Resources/Private/Tcpdf/config/lang/cat.php";s:4:"3b18";s:43:"Resources/Private/Tcpdf/config/lang/ces.php";s:4:"a21b";s:43:"Resources/Private/Tcpdf/config/lang/chi.php";s:4:"d30b";s:43:"Resources/Private/Tcpdf/config/lang/cym.php";s:4:"8cb4";s:43:"Resources/Private/Tcpdf/config/lang/dan.php";s:4:"0fe1";s:43:"Resources/Private/Tcpdf/config/lang/eng.php";s:4:"af88";s:43:"Resources/Private/Tcpdf/config/lang/est.php";s:4:"3fa8";s:43:"Resources/Private/Tcpdf/config/lang/eus.php";s:4:"e0b1";s:43:"Resources/Private/Tcpdf/config/lang/far.php";s:4:"47a6";s:43:"Resources/Private/Tcpdf/config/lang/fra.php";s:4:"f056";s:43:"Resources/Private/Tcpdf/config/lang/ger.php";s:4:"8fbb";s:43:"Resources/Private/Tcpdf/config/lang/gle.php";s:4:"658b";s:43:"Resources/Private/Tcpdf/config/lang/glg.php";s:4:"aeed";s:43:"Resources/Private/Tcpdf/config/lang/hat.php";s:4:"119c";s:43:"Resources/Private/Tcpdf/config/lang/heb.php";s:4:"8b87";s:43:"Resources/Private/Tcpdf/config/lang/hrv.php";s:4:"ee77";s:43:"Resources/Private/Tcpdf/config/lang/hun.php";s:4:"7973";s:43:"Resources/Private/Tcpdf/config/lang/hye.php";s:4:"ae6d";s:43:"Resources/Private/Tcpdf/config/lang/ind.php";s:4:"c139";s:43:"Resources/Private/Tcpdf/config/lang/ita.php";s:4:"d74f";s:43:"Resources/Private/Tcpdf/config/lang/jpn.php";s:4:"5767";s:43:"Resources/Private/Tcpdf/config/lang/kat.php";s:4:"53f4";s:43:"Resources/Private/Tcpdf/config/lang/kor.php";s:4:"e527";s:43:"Resources/Private/Tcpdf/config/lang/mkd.php";s:4:"8719";s:43:"Resources/Private/Tcpdf/config/lang/mlt.php";s:4:"49fe";s:43:"Resources/Private/Tcpdf/config/lang/msa.php";s:4:"446f";s:43:"Resources/Private/Tcpdf/config/lang/nld.php";s:4:"dc17";s:43:"Resources/Private/Tcpdf/config/lang/nob.php";s:4:"80c2";s:43:"Resources/Private/Tcpdf/config/lang/pol.php";s:4:"2a19";s:43:"Resources/Private/Tcpdf/config/lang/por.php";s:4:"4e5e";s:43:"Resources/Private/Tcpdf/config/lang/ron.php";s:4:"97a5";s:43:"Resources/Private/Tcpdf/config/lang/rus.php";s:4:"9195";s:43:"Resources/Private/Tcpdf/config/lang/slv.php";s:4:"482e";s:43:"Resources/Private/Tcpdf/config/lang/spa.php";s:4:"d94a";s:43:"Resources/Private/Tcpdf/config/lang/sqi.php";s:4:"8e2d";s:43:"Resources/Private/Tcpdf/config/lang/srp.php";s:4:"cbb3";s:43:"Resources/Private/Tcpdf/config/lang/swa.php";s:4:"28dd";s:43:"Resources/Private/Tcpdf/config/lang/swe.php";s:4:"3426";s:43:"Resources/Private/Tcpdf/config/lang/ukr.php";s:4:"2f27";s:43:"Resources/Private/Tcpdf/config/lang/urd.php";s:4:"db5c";s:43:"Resources/Private/Tcpdf/config/lang/yid.php";s:4:"3514";s:43:"Resources/Private/Tcpdf/config/lang/zho.php";s:4:"ad33";s:38:"Resources/Private/Tcpdf/doc/index.html";s:4:"39c0";s:40:"Resources/Private/Tcpdf/fonts/cid0cs.php";s:4:"4d82";s:40:"Resources/Private/Tcpdf/fonts/cid0ct.php";s:4:"42d2";s:40:"Resources/Private/Tcpdf/fonts/cid0jp.php";s:4:"832d";s:40:"Resources/Private/Tcpdf/fonts/cid0kr.php";s:4:"bf6b";s:41:"Resources/Private/Tcpdf/fonts/courier.php";s:4:"2894";s:42:"Resources/Private/Tcpdf/fonts/courierb.php";s:4:"baad";s:43:"Resources/Private/Tcpdf/fonts/courierbi.php";s:4:"f938";s:42:"Resources/Private/Tcpdf/fonts/courieri.php";s:4:"afdc";s:43:"Resources/Private/Tcpdf/fonts/helvetica.php";s:4:"2a31";s:44:"Resources/Private/Tcpdf/fonts/helveticab.php";s:4:"3daa";s:45:"Resources/Private/Tcpdf/fonts/helveticabi.php";s:4:"c22f";s:44:"Resources/Private/Tcpdf/fonts/helveticai.php";s:4:"e0a7";s:54:"Resources/Private/Tcpdf/fonts/hysmyeongjostdmedium.php";s:4:"51f6";s:48:"Resources/Private/Tcpdf/fonts/kozgopromedium.php";s:4:"2c5e";s:50:"Resources/Private/Tcpdf/fonts/kozminproregular.php";s:4:"78fd";s:47:"Resources/Private/Tcpdf/fonts/msungstdlight.php";s:4:"c940";s:48:"Resources/Private/Tcpdf/fonts/stsongstdlight.php";s:4:"eb85";s:40:"Resources/Private/Tcpdf/fonts/symbol.php";s:4:"20e2";s:39:"Resources/Private/Tcpdf/fonts/times.php";s:4:"a750";s:40:"Resources/Private/Tcpdf/fonts/timesb.php";s:4:"ad48";s:41:"Resources/Private/Tcpdf/fonts/timesbi.php";s:4:"a5f3";s:40:"Resources/Private/Tcpdf/fonts/timesi.php";s:4:"8fd8";s:46:"Resources/Private/Tcpdf/fonts/uni2cid_ac15.php";s:4:"96c6";s:46:"Resources/Private/Tcpdf/fonts/uni2cid_ag15.php";s:4:"0f60";s:46:"Resources/Private/Tcpdf/fonts/uni2cid_aj16.php";s:4:"c458";s:46:"Resources/Private/Tcpdf/fonts/uni2cid_ak12.php";s:4:"7ad3";s:46:"Resources/Private/Tcpdf/fonts/zapfdingbats.php";s:4:"191b";s:40:"Resources/Private/Tcpdf/include/sRGB.icc";s:4:"060e";s:48:"Resources/Private/Tcpdf/include/tcpdf_colors.php";s:4:"ae07";s:49:"Resources/Private/Tcpdf/include/tcpdf_filters.php";s:4:"80f8";s:51:"Resources/Private/Tcpdf/include/tcpdf_font_data.php";s:4:"78a8";s:47:"Resources/Private/Tcpdf/include/tcpdf_fonts.php";s:4:"8cd0";s:48:"Resources/Private/Tcpdf/include/tcpdf_images.php";s:4:"a77c";s:48:"Resources/Private/Tcpdf/include/tcpdf_static.php";s:4:"261e";s:55:"Resources/Private/Tcpdf/include/barcodes/datamatrix.php";s:4:"714c";s:51:"Resources/Private/Tcpdf/include/barcodes/pdf417.php";s:4:"9fb3";s:51:"Resources/Private/Tcpdf/include/barcodes/qrcode.php";s:4:"abc2";s:44:"Resources/Private/Templates/Device/List.html";s:4:"01be";s:31:"Resources/Public/Css/module.css";s:4:"817c";s:30:"Resources/Public/Icons/odl.png";s:4:"0b85";s:34:"Resources/Public/Icons/Wizicon.png";s:4:"ad35";s:40:"Resources/Public/Images/odl-nbg-dark.eps";s:4:"add1";s:48:"Resources/Public/Images/odl-nbg-hor-de-white.eps";s:4:"ac25";s:47:"Resources/Public/Images/odl-nbg-ver-de-dark.eps";s:4:"5299";s:48:"Resources/Public/Images/odl-nbg-ver-de-white.eps";s:4:"dcfb";s:48:"Resources/Public/Images/odl-nbg-ver-de-white.png";s:4:"c388";s:29:"Resources/Public/Js/module.js";s:4:"3624";s:14:"doc/manual.pdf";s:4:"0d55";s:14:"doc/manual.sxw";s:4:"4f6e";}',
);

?>
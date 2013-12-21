<?php

namespace Tollwerk\TwOdl\ViewHelpers;

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

// Require the TCPDF library
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('tw_odl', 'Resources/Private/Tcpdf/tcpdf.php');

/**
 * Initializes TCPDF functionality and renders the label PDF
 *
 * = Examples =
 *
 * <code title="Minimal initialization (endless paper)">
 * <odl:tcpdf width="62" labelheight="30"> ... </odl:tcpdf>
 * </code>
 * <output>
 * Starts label rendering on a 62 mm wide endless paper. There will be no page margins, no spacing between the labels, and each label will be 30 mm high. (Millimeters are the default unit)
 * </output>
 *
 * <code title="Fixed paper size">
 * <odl:tcpdf width="8.5" height="11" unit="inch" rows="5" columns="5" top="0.5" left="0.5" right="0.5" bottom="0.5" spacing="0.5"> ... </odl:tcpdf>
 * </code>
 * <output>
 * The labels will be rendered to 8½ × 11 inch page (letter format). There will be a ½ inch overall margin as well as a ½ inch spacing between all label cells. There will be 5 label rows and columns on the page, while the label size will be determined automatically.
 * </output>
 *
 * <code title="Label borders and offset">
 * <odl:tcpdf width="210" height="297" rows="5" columns="8" top="1" left="1" right="1" bottom="1" borderwidth="0.05" bordercolor="{0: 100, 1: 100, 2: 100}" offset="7"> ... </odl:tcpdf>
 * </code>
 * <output>
 * In this case there will be drawn a grey border around each label cell. Furthermore, there will be 7 blank labels at the beginning of the first page (e.g. useful when working with partially used label sticker sheets) 
 * </output>
 *
 * @api
 */
class TcpdfViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper {
	/**
	 * TCPDF instance
	 * 
	 * @var \TCPDF
	 */
	protected $_tcpdf = null;
	/**
	 * Page width
	 * 
	 * @var \float
	 */
	protected $_width = null;
	/**
	 * Page height
	 *
	 * @var \float
	 */
	protected $_height = null;
	/**
	 * Label rows per page
	 * 
	 * @var \integer
	 */
	protected $_rows = null;
	/**
	 * Label columns per page
	 *
	 * @var \integer
	 */
	protected $_columns = null;
	/**
	 * Endless label paper
	 * 
	 * @var \boolean
	 */
	protected $_endless = null;
	/**
	 * Top margin
	 * 
	 * @var \float
	 */
	protected $_top = null;
	/**
	 * Bottom margin
	 *
	 * @var \float
	 */
	protected $_bottom = null;
	/**
	 * Left margin
	 *
	 * @var \float
	 */
	protected $_left = null;
	/**
	 * Right margin
	 *
	 * @var \float
	 */
	protected $_right = null;
	/**
	 * Label spacing
	 *
	 * @var \float
	 */
	protected $_spacing = null;
	/**
	 * Label width
	 * 
	 * @var \float
	 */
	protected $_labelwidth = null;
	/**
	 * Label height (if no page height is given / endless paper)
	 *
	 * @var \float
	 */
	protected $_labelheight = null;
	/**
	 * Max. number of labels per page (if not endless paper)
	 * 
	 * @var \integer
	 */
	protected $_labellimit = 0;
	/**
	 * Label border width
	 *
	 * @var \float
	 */
	protected $_borderwidth = 0;
	/**
	 * Label border color (RGB values)
	 * 
	 * @var array
	 */
	protected $_bordercolor = array(0, 0, 0);
	/**
	 * Configuration manager instance
	 * 
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;
	/**
	 * Label offset
	 * 
	 * @var \integer
	 */
	protected $_offset = 0; 
	/**
	 * Map of registered fonts
	 * 
	 * @var \array
	 */
	protected $_fontmap = array();
	/**
	 * Default font size
	 * 
	 * @var \float
	 */
	protected $_fontsize = 11;
	
	/**
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}

	/**
	 * PDF label generation
	 * 
	 * @param \float $width						Page width
	 * @param \float $height					Page height (NULL = endless paper)
	 * @param \string $unit						Measurement unit
	 * @param \integer $rows					Number of label rows
	 * @param \integer $columns					Number of label columns (min 1)
	 * @param \float $top						Top margin
	 * @param \float $bottom					Bottom margin
	 * @param \float $left						Left margin
	 * @param \float $right						Right margin
	 * @param \float $spacing					Label spacing
	 * @param \float $labelheight				Label height (if no page height is given / endless paper)
	 * @param \float $borderwidth				Label border width
	 * @param \array $bordercolor				Label border color
	 * @param \integer $offset					Label offset (number of blank labels in the beginning of the document)
	 * @param \float $fontsize					Font size 
	 * @return void
	 */
	public function render($width, $height = null, $unit = 'mm', $rows = null, $columns = 1, $top = 0, $bottom = 0, $left = 0, $right = 0, $spacing = 0, $labelheight = 10, $borderwidth = 0, array $bordercolor = array(0, 0, 0), $offset = 0, $fontsize = 11) {
		$width					= floatval($width);
		$this->_width			= $width ? $width : 1;
		$this->_endless			= ($height === null);
		if ($this->_endless) {
			$this->_height		= null;
		} else {
			$height				= max(0, floatval($height));
			$this->_height		= $height ? $height : 1;
		}
		$rows					= max(0, intval($rows));
		$this->_rows			= $this->_endless ? null : ($rows ? $rows : 1);
		$this->_columns			= max(1, intval($columns));
		$this->_top				= max(0, floatval($top));
		$this->_bottom			= max(0, floatval($bottom));
		$this->_left			= max(0, floatval($left));
		$this->_right			= max(0, floatval($right));
		$this->_spacing			= max(0, floatval($spacing));
		$labelheight			= max(0, floatval($labelheight));
		$this->_labelheight		= $this->_endless ? ($labelheight ? $labelheight : 1) : (($this->_height - $this->_top - $this->_bottom - ($this->_rows - 1) * $this->_spacing) / $this->_rows);
		$this->_labelwidth		= ($this->_width - $this->_left - $this->_right - ($this->_columns - 1) * $this->_spacing) / $this->_columns;
		$this->_labellimit		= $this->_endless ? 0 : ($this->_rows * $this->_columns);
		$this->_borderwidth		= max(0, floatval($borderwidth));
		$this->_bordercolor		= array_pad(array_map('intval', array_values($bordercolor)), 3, 0);
		$this->_offset			= $this->_labellimit ? (max(0, intval($offset)) % $this->_labellimit) : 0;
		$this->_fontsize		= max(0, floatval($fontsize));
		$this->_fontsize		= $this->_fontsize ? $this->_fontsize : 11;
		
		// Preparing the TCPDF command stack
		$this->templateVariableContainer->add('tcpdf', array());
		
		// Render all children
		$this->renderChildren();
		
		// Retrieving the filled TCPDF command stack
		try {
			$commands			= (array)$this->templateVariableContainer->get('tcpdf');
			$this->templateVariableContainer->remove('tcpdf');
		} catch (\TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException $e) {
			$commands			= array();
		}
		
		// If any TCPDF commands have been issued
		if (count($commands)) {
			
			// Change to the TCPDF local font directory as working directory
			chdir(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3temp/tcpdf-fonts'));
			
			$this->_tcpdf		= new \TCPDF('P', $unit);
			$this->_tcpdf->setPrintHeader(false);
			$this->_tcpdf->setPrintFooter(false);
			$this->_tcpdf->setFontSubsetting(true);
			$this->_tcpdf->SetAutoPageBreak(false);
			
			// Run through all commands and compose labels
			$labels				= array_pad(array(), $this->_offset, array());
			$label				= null;
			foreach ($commands as $command) {
				switch($command[0]) {
					
					// Start a new label
					case 'label':
						unset($label);
						
						// Finalize the previous page if the labels would overflow
						if ($this->_labellimit && (count($labels) == $this->_labellimit)) {
							$this->_renderPage($labels);
							$labels			= array();
						}
						
						// Start a new label
						$labels[]			= array();
						$label				=& $labels[count($labels) - 1];
						break;
						
					// Start a new page
					case 'page':
						if (count($labels)) {
							unset($label);
							$this->_renderPage($labels);
							$labels			= array();
						}
						break;
						
					// Register a font
					case 'font':
						$fontFile			= \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($command[2]);
						if (@is_file($fontFile)) {
							$fontFamily		= strtolower($command[1]);
							$fontStyle		= $this->_normalizedFontStyle($command[3]);
							
							// Create the font family map entry if necessary
							if (!array_key_exists($fontFamily, $this->_fontmap)) {
								$this->_fontmap[$fontFamily]			= array();
							}
							
							// Register the font style
							$this->_fontmap[$fontFamily][$fontStyle]	= $this->_tcpdf->addTTFfont($fontFile, '', '', 32, \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3temp/tcpdf-fonts').DIRECTORY_SEPARATOR);
						}
						break;
						
					// All other commands
					default:
						if ($label !== null) {
							$label[]		= $command;
						}
						break;
				}
			}
			
			// Render remaining labels (if any)
			if (count($labels)) {
				$this->_renderPage($labels);
			}
			
			// Output PDF file
			$this->_tcpdf->Output('ODL Labels', 'I');
			exit;
		}
	}
	
	/**
	 * Render a label page
	 * 
	 * @return void
	 * @link \TCPDF::setPageFormat
	 */
	protected function _renderPage(array $labels) {
		
		// Calculate the page height if endless paper
		if ($this->_endless) {
			$height			= (ceil(count($labels) / $this->_columns) * ($this->_labelheight + $this->_spacing)) - $this->_spacing + $this->_top + $this->_bottom;
			
		// Else
		} else {
			$height			= $this->_height;
		}
		
		// Add a PDF page
		$this->_tcpdf->AddPage(($this->_width > $height) ? 'L' : 'P', array(
			'MediaBox'		=> array(
				'llx'		=> 0,
				'lly'		=> 0,
				'urx'		=> $this->_width,
				'ury'		=> $height,
			)
		));
		
		// Render all labels on this page
		foreach ($labels as $index => $label) {
			
			// Determine absolute label cell offsets
			$left			= $this->_left + ($index % $this->_columns) * ($this->_labelwidth + $this->_spacing);
			$top			= $this->_top + floor($index / $this->_columns) * ($this->_labelheight + $this->_spacing);
			$bottom			= $top + $this->_labelheight;
			$right			= $left + $this->_labelwidth;
			
			// Set the relevant page margins to the label cell
			$this->_tcpdf->SetTopMargin($top);
			$this->_tcpdf->SetLeftMargin($left);
			$this->_tcpdf->SetRightMargin($this->_width - $right);
			
			// Render a label border
			if ($this->_borderwidth) {
				$this->_tcpdf->Rect($left, $top, $this->_labelwidth, $this->_labelheight, 'S', array('all' => array('width' => $this->_borderwidth, 'color' => $this->_bordercolor)));
			}
			
			// Run through all label commands
			foreach ($label as $command) {
				switch($command[0]) {
					
					// Render a text cell
					case 'text':
						$x								= ($command[2] === null) ? $this->_tcpdf->GetX() : ($left + max(floatval($command[2]), 0));
						$y								= ($command[3] === null) ? $this->_tcpdf->GetY() : ($top + max(floatval($command[3]), 0));
						$width							= max(floatval($command[4]), 0);
						$height							= max(floatval($command[5]), 0);
						$fontcolor						= array_pad(array_map('intval', array_values((array)$command[10])), 3, 0);
						$fontsize						= max(0, floatval($command[9]));
						$fontstyle						= $this->_normalizedFontStyle($command[8]);
						if (array_key_exists($command[7], $this->_fontmap) && array_key_exists($fontstyle, $this->_fontmap[$command[7]])) {
							$fontfamily					= $this->_fontmap[$command[7]][$fontstyle];
							$fontstyle					= '';
						} else {
							$fontfamily					= 'times';
						}
						$this->_tcpdf->SetFont($fontfamily, $fontstyle, $fontsize ? $fontsize : $this->_fontsize);
						$this->_tcpdf->SetTextColorArray($fontcolor);
						$this->_tcpdf->MultiCell($width, $height, html_entity_decode($command[1]), 0, $command[6], false, max(0, min(2, intval($command[11]))), $x, $y, true, 0, false, true, $height, $command[12]);
						break;
						
					// Render an image
					case 'image':
						$imageFile						= \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($command[1]);
						if (@is_file($imageFile)) {
							$restoreTopMargin			=
							$restoreLeftMargin			=
							$restoreRightMargin			= false;
							$topMargin					= floatval($command[5]);
							$leftMargin					= floatval($command[6]);
							$rightMargin				= floatval($command[7]);
								
							// Adapt the vertical margins with respect to the alignment
							$halign						= strlen(trim($command[1])) ? strtoupper(substr(trim($command[2]), 0, 1)) : 'L';
							if (in_array($halign, array('L', 'C')) && ($leftMargin > 0)) {
								$restoreLeftMargin		= true;
								$this->_tcpdf->SetLeftMargin($left + $leftMargin);
							}
							if (in_array($halign, array('R', 'C')) && ($rightMargin > 0)) {
								$restoreRightMargin		= true;
								$this->_tcpdf->SetRightMargin($this->_width - $right + $rightMargin);
							}
								
							switch (strtolower(pathinfo($imageFile, PATHINFO_EXTENSION))) {
								case 'ai':
								case 'eps':
									$this->_tcpdf->ImageEps($imageFile, $left + $leftMargin, $top + $topMargin, $command[3], $command[4], '', true, '', $halign);
									break;
									// 								case 'svg':
									// 									break;
								default:
									$this->_tcpdf->Image($imageFile, $left + $leftMargin, $top + $topMargin, $command[3], $command[4], '', '', '', true, 300, $halign);
									break;
							}
								
							if ($restoreTopMargin) {
								$this->_tcpdf->SetTopMargin($top);
							}
							if ($restoreLeftMargin) {
								$this->_tcpdf->SetLeftMargin($left);
							}
							if ($restoreRightMargin) {
								$this->_tcpdf->SetRightMargin($this->_width - $right);
							}
						}
						break;
				}
			}
		}
	}
	
	/**
	 * Normalize a font style string
	 * 
	 * @param string $fontStyle			Font style
	 * @return string					Normalized font style
	 */
	protected function _normalizedFontStyle($fontStyle) {
		$styles				= array();
		for ($c = 0; $c < strlen($fontStyle); ++$c) {
			$char			= strtolower($fontStyle{$c});
			if (strpos('biudor', $char) !== false) {
				$styles[]	= $char;
			} 
		}
		sort($styles, SORT_STRING);
		if (!count($styles)) {
			$styles			= array('r');
		}
		return implode('', $styles);
	}
}

?>
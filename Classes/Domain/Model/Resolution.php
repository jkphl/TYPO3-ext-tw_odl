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
 * CSS display resolution
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Resolution extends AbstractArrayable {
	/**
	 * Serializable properties
	 *
	 * @var array
	 */
	protected $_serializeProperties = array('width', 'height', 'ratio', 'orientation');
	
	/**
	 * Width
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $width;

	/**
	 * Height
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $height;

	/**
	 * Pixel ratio
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $ratio;

	/**
	 * Orientations
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $orientation;

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
	 * Returns the ratio
	 *
	 * @return \float $ratio
	 */
	public function getRatio() {
		return round($this->ratio, 4);
	}

	/**
	 * Sets the ratio
	 *
	 * @param \float $ratio
	 * @return void
	 */
	public function setRatio($ratio) {
		$this->ratio = $ratio;
	}

	/**
	 * Returns the orientation
	 *
	 * @return \integer $orientation
	 */
	public function getOrientation() {
		return $this->orientation;
	}

	/**
	 * Sets the orientation
	 *
	 * @param \integer $orientation
	 * @return void
	 */
	public function setOrientation($orientation) {
		$this->orientation = $orientation;
	}
	
	/**
	 * Return if the device ratio is off-standard
	 * 
	 * @return boolean			Off-standard ratio
	 */
	public function getSuperRatio() {
		return floatval($this->ratio) != 1;
	}
}

?>
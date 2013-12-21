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
 * Abstract base class for domain models that can be serialized as array
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AbstractArrayable extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	/**
	 * Serializable properties
	 * 
	 * @var array
	 */
	protected $_serializeProperties = array();
	
	/**
	 * Serialize this record as array
	 * 
	 * @return array			Serialized record
	 */
	public function toArray() {
		$array				= array();
		
		// Run through all object properties
		foreach ($this->_serializeProperties as $property) {
			try {
				if (isset($this->$property)) {
					$value				= @is_callable(array($this, 'get'.ucfirst($property))) ? $this->{'get'.ucfirst($property)}(true) : $this->$property;
					$array[$property]	= $this->_makeArrayValue($value);
				}
			} catch (\Exception $e) {}
		}
		
		switch (count($array)) {
			case 0:
				return null;
				break;
				
			case 1:
				return current($array);
				break;
				
			default:
				return $array;
				break;
		}
	}
	
	/**
	 * Convert a value for serialization
	 * 
	 * @param mixed $value		Value
	 * @return mixed			Converted value
	 * @throws \Exception		If the value cannot be serialized
	 */
	protected function _makeArrayValue($value) {

		// If the value is an object itself
		if (is_object($value)) {
		
			// If the object is serializable
			if ($value instanceof AbstractArrayable) {
				return $value->toArray();

			// Else if it's a lazy loading proxy
			} elseif ($value instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
				return $this->_makeArrayValue($value->_loadRealInstance());
				
			// Else if the object can be iterated
			} elseif ($value instanceof \Iterator) {
				$array				= array();
				foreach ($value as $element) {
					try {
						$array[]	= $this->_makeArrayValue($element);
					} catch (\Exception $e) {}
				}
				
				return $array;
				
			// Else: Value cannot be serialized
			} else {
				throw new \Exception();
			}
		
		// Else
		} else {
			return $value;
		}
	}
}

?>
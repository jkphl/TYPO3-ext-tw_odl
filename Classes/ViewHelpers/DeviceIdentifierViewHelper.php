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

/**
 * Renders a device identifier
 *
 * = Examples =
 *
 * <code title="Device identifier">
 * <odl:tcpdf.deviceIdentifier device="{device}" identifier="{settings.deviceIdentifier}" digits="{settings.deviceNumberDigits}"/>
 * </code>
 * <output>
 * Renders a device identifier by left-padding the device's uid with leading zeros (up to the length given by "digits") and substituting it into the identifier string given by "identifier" (sprintf-substitution) 
 * </output>
 *
 * @api
 */
class DeviceIdentifierViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Render the device identifier
	 * 
	 * @param \Tollwerk\TwOdl\Domain\Model\Device $device	Device
	 * @param \string $identifier							Device identifier pattern
	 * @param \integer $digits								Device number digits
	 * @return \string
	 */
	public function render(\Tollwerk\TwOdl\Domain\Model\Device $device, $identifier, $digits) {
		return sprintf($identifier, str_pad($device->getUid(), intval($digits), '0', STR_PAD_LEFT));
	}
}

?>
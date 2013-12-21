<?php

namespace Tollwerk\TwOdl\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Jeff Chi <jeff@tollwerk.de>, tollwerk GmbH
 *  Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
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
 * Device repository
 *
 * @package tw_odl
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DeviceRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	/**
	 * Default order
	 */
	protected $defaultOrderings = array(
		'manufacturer.name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
		'name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);
	
	/**
	 * Find devices by page ID
	 * 
	 * @param int $pid													Page ID
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface		Devices
	 */
	public function findByPid($pid) {
		$query			= $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds(array(intval($pid)));
		return $query->execute();
	}
	
	/**
	 * Find devices by primary keys
	 *
	 * @param array $uids												Primary keys
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface		Devices
	 */
	public function findByUids(array $uids) {
		$query			= $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		$query->matching($query->in('uid', $uids));
		return $query->execute();
	}
	
	/**
	 * Find devices by browser user agent string
	 * 
	 * @param string $userAgent											User agent string
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface		Devices
	 */
	public function findByInstalledBrowserUserAgent($userAgent) {
		$query			= $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(false);
		$query->matching($query->contains('browers.useragent', $userAgent));
		return $query->execute();
	}
}

?>
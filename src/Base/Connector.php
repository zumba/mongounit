<?php

namespace Zumba\PHPUnit\Extensions\Mongo\Base;

/**
 * Interface Connector
 * @package Zumba\PHPUnit\Extensions\Mongo\Base
 */
interface Connector {

	/**
	 * Get the connection.
	 *
	 * @return \MongoDB\Client
	 */
	public function getConnection();

	/**
	 * Get a collection object.
	 *
	 * @param string $name Name of the collection
	 * @return \MongoDB\Collection
	 */
	public function collection($name);

	/**
	 * Sets the db name to be used with this connector.
	 *
	 * @param string $name
	 * @return void
	 */
	public function setDb($name);

}

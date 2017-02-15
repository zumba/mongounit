<?php

namespace Zumba\PHPUnit\Extensions\Mongo;

/**
 * Class TestTrait
 * @package Zumba\PHPUnit\Extensions\Mongo
 */
trait TestTrait {

	/**
	 * Setup the mongo db with fixture data.
	 *
	 * @return void
	 * @before
	 */
	public function mongoSetUp() {
		if (!class_exists('MongoDB\Client')) {
			$this->markTestSkipped('The MongoDB extension is not available.');
			return;
		}
		$this->getMongoDataSet()
			->dropAllCollections()
			->buildCollections();
	}

	/**
	 * Cleanup after test.
	 *
	 * @return void
	 * @after
	 */
	public function mongoTearDown() {
		$this->getMongoDataSet()->dropAllCollections();
	}

	/**
	 * Retrieve a mongo connection client.
	 *
	 * @return \Zumba\PHPUnit\Extensions\Mongo\Client\Connector
	 */
	protected abstract function getMongoConnection();

	/**
	 * Retrieve a DataSet object.
	 *
	 * @return \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet
	 */
	protected abstract function getMongoDataSet();

}

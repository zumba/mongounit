<?php

namespace Zumba\PHPUnit\Extensions\Mongo;
use \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;
use \Zumba\PHPUnit\Extensions\Mongo\Client\Connector;

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
		if (!class_exists('MongoClient')) {
			$this->markTestSkipped('The Mongo extension is not available.');
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
     * @return Connector
     */
	protected abstract function getMongoConnection();

    /**
     * Retrieve a DataSet object.
     *
     * @return DataSet
     */
	protected abstract function getMongoDataSet();

}

<?php

namespace PHPUnit\Extensions\Mongo;
use PHPUnit\Extensions\Mongo\DataSet\DataSet;

abstract class TestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * Setup the mongo db with fixture data.
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		if (!class_exists('MongoClient')) {
			$this->markTestSkipped('The Mongo extension is not available.');
			return;
		}
		$this->getDataSet()
			->dropAllCollections()
			->buildCollections();
	}

	/**
	 * Cleanup after test.
	 *
	 * @return void
	 */
	public function tearDown() {
		parent::tearDown();
		$this->dataSet->dropAllCollections();
	}

	/**
	 * Retrieve a mongo connection client.
	 *
	 * @return PHPUnit\Extensions\Mongo\Client\Connector
	 */
	protected abstract function getConnection();

	/**
	 * Retrieve a dataset object.
	 *
	 * @return PHPUnit\Extensions\Mongo\DataSet\DataSet
	 */
	protected abstract function getDataSet();

}
<?php

use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;

class ConnectorTest extends \PHPUnit_Framework_TestCase {

	public function testGeneralConnection() {
		$connection = new Connector(new \MongoDB\Client());
		$connection->setDb('test');
		$this->assertInstanceOf('Zumba\PHPUnit\Extensions\Mongo\Client\Connector', $connection);
		$connection->collection('test')->insertOne([
			'document' => 'test document'
		]);
		$this->assertSame(1, $connection->collection('test')->count());
		$connection->collection('test')->drop();
	}

}

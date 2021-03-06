<?php

/**
 * Unit test for DownloadEvent component.
 */
class DownloadEventTest extends CTestCase
{
	/**
	 * Tests get mappings.
	 */
	public function testGetMappings()
	{
		$event = new DownloadEvent();
		$mappings = $event->getMappings();
		$this->assertEquals(4, count($mappings));
		$this->assertTrue(in_array(DownloadEvent::BRONZE_COUNT, $mappings));
		$this->assertTrue(in_array(DownloadEvent::SILVER_COUNT, $mappings));
		$this->assertTrue(in_array(DownloadEvent::GOLD_COUNT, $mappings));
	}
}
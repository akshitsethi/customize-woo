<?php

use AkshitSethi\Plugins\CustomizeWoo\Config;

class ConfigTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @var \WpunitTester
     */
    protected $tester;
    
    public function setUp(): void
    {
        // Before...
        parent::setUp();

        // Your set up methods here.
        \WP_Mock::setUsePatchwork( true );
		\WP_Mock::setUp();
    }

    public function tearDown(): void
    {
        // Your tear down methods here.

        // Then...
        parent::tearDown();
    }

    // Tests
    public function test_get_plugin_name()
    {
        $config = new Config();
        $this->assertEquals(
            'Customize Woo',
            $config->get_plugin_name()
        );
    }
}

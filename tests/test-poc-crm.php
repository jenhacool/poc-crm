<?php

class Test_POC_CRM extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function test_constant_defined()
    {
        $this->assertTrue( defined( 'POC_CRM_PLUGIN_FILE' ) );
        $this->assertTrue( defined( 'POC_CRM_PLUGIN_DIR' ) );
        $this->assertTrue( defined( 'POC_CRM_PLUGIN_URL' ) );
    }

    public function test_register_activation_hook()
    {
        $this->assertGreaterThan(
            0,
            has_action(
                'activate_' . plugin_basename( POC_CRM_PLUGIN_FILE ),
                array( 'POC_CRM', 'activate' )
            )
        );
    }

    public function test_register_deactivation_hook()
    {
        $this->assertGreaterThan(
            0,
            has_action(
                'deactivate_' . plugin_basename( POC_CRM_PLUGIN_FILE ),
                array( 'POC_CRM', 'deactivate' )
            )
        );
    }
}
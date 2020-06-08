<?php

use POC\CRM\POC_CRM;

class Test_Class_POC_CRM extends WP_UnitTestCase
{
    public $instance;

    public function setUp()
    {
        parent::setUp();

        $this->instance = POC_CRM::instance();
    }

    public function test_add_hooks()
    {
        $this->assertGreaterThan(
            0,
            has_action(
                'init',
                array( $this->instance, 'add_rewrite_rules' )
            )
        );

        $this->assertGreaterThan(
            0,
            has_filter(
                'template_include',
                array( $this->instance, 'include_template' )
            )
        );

        $this->assertGreaterThan(
            0,
            has_action(
                'rest_api_init',
                array( $this->instance->rest_api, 'register_rest_routes' )
            )
        );
    }

    public function test_add_rewrite_rules()
    {
        global $wp_rewrite;

        $this->instance->add_rewrite_rules();

        $this->assertArrayHasKey( 'crm', $wp_rewrite->extra_rules_top );
        $this->assertSame( 'index.php?pagename=crm', $wp_rewrite->extra_rules_top['crm'] );
    }

    public function test_include_template()
    {
        set_query_var( 'pagename', 'non-crm' );

        $template = $this->instance->include_template( 'original_template' );

        $this->assertEquals( 'original_template', $template );

        set_query_var( 'pagename', 'crm' );

        $template = $this->instance->include_template( 'original_template' );

        $this->assertEquals( POC_CRM_PLUGIN_DIR . 'views/crm.php', $template );
    }
}
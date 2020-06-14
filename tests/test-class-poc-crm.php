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

        $this->assertGreaterThan(
            0,
            has_action(
                'admin_post_nopriv_poc_crm_login',
                array( $this->instance->auth, 'login' )
            )
        );

        $this->assertGreaterThan(
            0,
            has_action(
                'admin_post_poc_crm_login',
                array( $this->instance->auth, 'login' )
            )
        );
    }

    public function test_add_rewrite_rules()
    {
        global $wp_rewrite;

        $this->instance->add_rewrite_rules();

        $this->assertArrayHasKey( 'poc-crm/login', $wp_rewrite->extra_rules_top );
        $this->assertSame( 'index.php?pagename=poc-crm-login', $wp_rewrite->extra_rules_top['poc-crm/login'] );

        $this->assertArrayHasKey( 'poc-crm/dashboard', $wp_rewrite->extra_rules_top );
        $this->assertSame( 'index.php?pagename=poc-crm-dashboard', $wp_rewrite->extra_rules_top['poc-crm/dashboard'] );
    }

    public function test_include_template()
    {
        set_query_var( 'pagename', 'non-crm' );

        $template = $this->instance->include_template( 'original_template' );

        $this->assertEquals( 'original_template', $template );

        set_query_var( 'pagename', 'poc-crm-login' );

        $template = $this->instance->include_template( 'original_template' );

        $this->assertEquals( POC_CRM_PLUGIN_DIR . 'views/login.php', $template );

        set_query_var( 'pagename', 'poc-crm-dashboard' );

        $template = $this->instance->include_template( 'original_template' );

        $this->assertEquals( POC_CRM_PLUGIN_DIR . 'views/dashboard.php', $template );
    }
}
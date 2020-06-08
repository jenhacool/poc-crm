<?php

namespace POC\CRM\Tests\REST;

abstract class POC_CRM_Abstract_Controller_Test extends \WP_UnitTestCase
{
    public $server;

    public $routes = [];

    public function setUp()
    {
        parent::setUp();

        global $wp_rest_server;

        $wp_rest_server = new \Spy_REST_Server();

        $this->server = $wp_rest_server;

        do_action( 'rest_api_init' );
    }

    public function tearDown()
    {
        parent::tearDown();

        global $wp_rest_server;

        unset( $this->server );

        $wp_rest_server = null;
    }

    public function test_register_routes()
    {
        $actual_routes = $this->server->get_routes();

        $expected_routes = $this->routes;

        foreach ( $expected_routes as $expected_route ) {
            $this->assertArrayHasKey( $expected_route, $actual_routes );
        }
    }
}
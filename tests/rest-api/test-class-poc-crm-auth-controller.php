<?php

namespace POC\CRM\Tests\REST;

use POC\CRM\REST\POC_CRM_Auth_Controller;

class Test_Class_POC_CRM_Auth_Controller extends POC_CRM_Abstract_Controller_Test {
    public $controller;

    public $routes = array(
        '/poc-crm/v1/login'
    );

    public function setUp()
    {
        parent::setUp();

        $this->controller = new POC_CRM_Auth_Controller();

        $this->factory()->user->create( array(
            'user_pass'  => 'test',
            'user_email' => 'test@gmail.com',
        ) );
    }

    public function test_login()
    {
        $request = new \WP_REST_Request();

        $request->set_header( 'Content-Type', 'application/json' );

        $request->set_body( json_encode( array(
            'email' => 'test@gmail.com',
            'password' => 'test'
        ) ) );

        $response = $this->controller->login( $request );

        $expected_data = array(
            'nonce' => wp_create_nonce( 'rest-api' )
        );

        $this->assertEquals( $expected_data, $response->get_data() );
    }

    public function test_login_with_wrong_password_fail()
    {
        $request = new \WP_REST_Request();

        $request->set_body_params( array(
            'email' => 'test@gmail.com',
            'password' => 'wrong_password'
        ) );

        $response = $this->controller->login( $request );

        $expected_data = array(
            'message' => 'Wrong password. Please check again.'
        );

        $this->assertEquals( $expected_data, $response->get_data() );
        $this->assertEquals( 422, $response->get_status() );
    }

    public function test_login_with_wrong_email_fail()
    {
        $request = new \WP_REST_Request();

        $request->set_body_params( array(
            'email' => 'wrong_email',
            'password' => 'test'
        ) );

        $response = $this->controller->login( $request );

        $expected_data = array(
            'message' => 'User doesn\'t exists. Please check again.'
        );

        $this->assertEquals( $expected_data, $response->get_data() );
        $this->assertEquals( 422, $response->get_status() );
    }
}
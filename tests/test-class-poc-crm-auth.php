<?php

use POC\CRM\POC_CRM_Auth;

class Test_Class_POC_CRM_Auth extends \WP_UnitTestCase
{
    public $instance;

    public function setUp()
    {
        parent::setUp();

        $this->instance = new POC_CRM_Auth();
    }

    public function test_login()
    {
        $instance = $this->getMockBuilder( POC_CRM_Auth::class )->setMethods( ['redirect_to_dashboard'] )->getMock();

        $instance->expects( $this->once() )->method( 'redirect_to_dashboard' );

        $this->create_dummy_user();

        $_POST['username'] = 'test';
        $_POST['password'] = 'tests';

        $this->assertTrue( true != $instance->login() );
    }

    public function test_login_with_wrong_username()
    {
        $instance = $this->getMockBuilder( POC_CRM_Auth::class )->setMethods( ['redirect_to_login'] )->getMock();

        $instance->expects( $this->once() )->method( 'redirect_to_login' );

        $this->create_dummy_user();

        $_POST['username'] = 'wrong_username';
        $_POST['password'] = 'test';

        $this->assertTrue( true != $instance->login() );
    }

    public function test_login_with_wrong_password()
    {
        $instance = $this->getMockBuilder( POC_CRM_Auth::class )->setMethods( ['redirect_to_login'] )->getMock();

        $instance->expects( $this->once() )->method( 'redirect_to_login' );

        $this->create_dummy_user();

        $_POST['username'] = 'test';
        $_POST['password'] = 'wrong_password';

        $this->assertTrue( true != $instance->login() );
    }

    protected function create_dummy_user()
    {
        $this->factory()->user->create( array(
            'user_login' => 'test',
            'user_pass'  => 'test',
            'user_email' => 'test@gmail.com',
        ) );
    }
}
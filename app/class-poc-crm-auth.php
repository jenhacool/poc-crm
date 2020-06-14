<?php

namespace POC\CRM;

class POC_CRM_Auth
{
    public function login()
    {
        if( empty( $_POST['username'] ) || empty( $_POST['password'] ) ) {
            return $this->redirect_to_login();
        }

        $auth = wp_signon( array(
            'user_login' => $_POST['username'],
            'user_password' => $_POST['password']
        ) );

        if( is_wp_error( $auth ) ) {
            return $this->redirect_to_login();
        }

        return $this->redirect_to_dashboard();
    }

    protected function redirect_to_dashboard()
    {
        wp_safe_redirect( home_url( 'poc-crm/dashboard' ) );
        exit;
    }

    protected function redirect_to_login()
    {
        wp_safe_redirect( home_url( 'poc-crm/login' ) . '?login_failed=true' );
        exit;
    }
}
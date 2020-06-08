<?php

namespace POC\CRM\REST;

class POC_CRM_Auth_Controller extends POC_CRM_Abstract_Controller
{
    public function register_routes()
    {
        register_rest_route(
            $this->namespace,
            '/login',
            array(
                'methods' => 'POST',
                'callback' => array( $this, 'login' )
            ),
            true
        );
    }

    /**
     * REST API Login
     *
     * @param \WP_REST_Request $request
     */
    public function login( $request )
    {
        $params = $request->get_json_params();

        $email = $params['email'];

        $password = $params['password'];

        $user = get_user_by( 'email', $email );

        if( ! $user ) {
            return $this->response( array(
                'message' => 'User doesn\'t exists. Please check again.'
            ), 422 );
        }

        $authenticate = wp_check_password( $password, $user->user_pass, $user->ID );

        if( ! $authenticate ) {
            return $this->response( array(
                'message' => 'Wrong password. Please check again.'
            ), 422 );
        }

        wp_set_current_user( $user->ID );

        $data = array(
            'nonce' => wp_create_nonce( 'rest-api' )
        );

        return $this->response( $data );
    }

    protected function response( $data, $status = 200 )
    {
        $response = new \WP_REST_Response();

        $response->set_data( $data );

        $response->set_status( $status );

        return $response;
    }
}
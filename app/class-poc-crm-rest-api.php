<?php

namespace POC\CRM;

class POC_CRM_REST_API
{
    /**
     * Register rest routes.
     */
    public function register_rest_routes()
    {
        foreach( $this->get_controller_classes() as $controller_class ) {
            $controller = new $controller_class();
            $controller->register_routes();
        }
    }

    /**
     * Get controller classes
     *
     * @return array
     */
    protected function get_controller_classes()
    {
        return array(
            'POC\CRM\REST\POC_CRM_Auth_Controller'
        );
    }
}
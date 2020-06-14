<?php

namespace POC\CRM;

use POC\CRM\Utilities\SingletonTrait;

class POC_CRM
{
    use SingletonTrait;

    public $rest_api;

    public $auth;

    /**
     * POC_CRM constructor.
     */
    protected function __construct()
    {
        $this->init_classes();

        $this->add_hooks();
    }

    /**
     * Init classes
     */
    protected function init_classes()
    {
        $this->rest_api = new POC_CRM_REST_API();

        $this->auth = new POC_CRM_Auth();
    }

    /**
     * Add hooks
     */
    protected function add_hooks()
    {
        add_action( 'init', array( $this, 'add_rewrite_rules' ) );

        add_filter( 'template_include', array( $this, 'include_template' ) );

        add_action( 'rest_api_init', array( $this->rest_api, 'register_rest_routes' ) );

        add_action( 'admin_post_nopriv_poc_crm_login', array( $this->auth, 'login' ) );

        add_action( 'admin_post_poc_crm_login', array( $this->auth, 'login' ) );
    }

    /**
     * Add custom rewrite rules
     */
    public function add_rewrite_rules()
    {
        add_rewrite_rule( 'poc-crm/dashboard', 'index.php?pagename=poc-crm-dashboard', 'top' );
        add_rewrite_rule( 'poc-crm/login', 'index.php?pagename=poc-crm-login', 'top' );
    }

    /**
     * Include custom template
     *
     * @param $original_template
     *
     * @return string
     */
    public function include_template( $original_template )
    {
        $pagename = get_query_var( 'pagename' );

        if( $pagename != 'poc-crm-login' && $pagename != 'poc-crm-dashboard' ) {
            return $original_template;
        }

        if( $pagename === 'poc-crm-login' ) {
            return POC_CRM_PLUGIN_DIR . 'views/login.php';
        }

        return POC_CRM_PLUGIN_DIR . 'views/dashboard.php';
    }

    /**
     * On activate plugin
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }

    /**
     * On deactivate plugin
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
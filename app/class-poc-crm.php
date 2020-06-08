<?php

namespace POC\CRM;

use POC\CRM\Utilities\SingletonTrait;

class POC_CRM
{
    use SingletonTrait;

    public $rest_api;

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
    }

    /**
     * Add hooks
     */
    protected function add_hooks()
    {
        add_action( 'init', array( $this, 'add_rewrite_rules' ) );

        add_filter( 'template_include', array( $this, 'include_template' ) );

        add_action( 'rest_api_init', array( $this->rest_api, 'register_rest_routes' ) );
    }

    /**
     * Add custom rewrite rules
     */
    public function add_rewrite_rules()
    {
        add_rewrite_rule( 'crm', 'index.php?pagename=crm', 'top' );
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
        if( get_query_var( 'pagename' ) != 'crm' ) {
            return $original_template;
        }

        return POC_CRM_PLUGIN_DIR . 'views/crm.php';
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
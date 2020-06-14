<?php
if( ! is_user_logged_in() ) {
    wp_redirect( home_url( 'poc-crm/login' ) );
    exit;
}

require_once POC_CRM_PLUGIN_DIR . 'views/layout/header.php';
?>
    <div class="container bg-gray-200">
        <div class="w-full max-w-xs">

        </div>
    </div>
<?php
require_once POC_CRM_PLUGIN_DIR . 'views/layout/footer.php';
?>

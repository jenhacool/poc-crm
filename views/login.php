<?php
if( is_user_logged_in() ) {
    wp_redirect( home_url( 'poc-crm/dashboard' ) );
    exit;
}

require_once POC_CRM_PLUGIN_DIR . 'views/layout/header.php';
?>
    <div class="container h-screen flex justify-center items-center bg-gray-200">
        <div class="w-full max-w-xs">
            <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="bg-white rounded p-4 mb-4">
                <input type="hidden" name="action" value="poc_crm_login">
                <?php if( isset( $_GET['login_failed'] ) ) : ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-2 rounded relative" role="alert">
                        <span class="block sm:inline">Bạn vui lòng kiểm tra lại thông tin username và password.</span>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="username">
                        Username
                    </label>
                    <input name="username" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2" for="password">
                        Password
                    </label>
                    <input name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Login In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>
            <p class="text-center text-gray-500 text-xs">
                &copy;2020 Acme Corp. All rights reserved.
            </p>
        </div>
    </div>
<?php
require_once POC_CRM_PLUGIN_DIR . 'views/layout/footer.php';
?>

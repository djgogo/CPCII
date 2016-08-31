<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'authenticator' => '/Authenticator.php',
                'factory' => '/Factory.php',
                'httprequest' => '/HttpRequest.php',
                'loginintegrationtest' => '/LoginIntegrationTest.php',
                'loginprocessor' => '/LoginProcessor.php',
                'mailer' => '/Mailer.php',
                'passwordlostprocessor' => '/PasswordLostProcessor.php',
                'processorinterface' => '/ProcessorInterface.php',
                'redirectprocessor' => '/RedirectProcessor.php',
                'router' => '/Router.php',
                'securepageprocessor' => '/SecurePageProcessor.php',
                'session' => '/Session.php',
                'sessionstore' => '/SessionStore.php',
                'sessionstorestub' => '/SessionStoreStub.php',
                'url' => '/Url.php',
                'usertabledatagateway' => '/UserTableDataGateway.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd

<?php
declare(strict_types = 1);

class AuthenticationController
{
    /**
     * @var Configuration
     */
    private $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function execute(string $username, string $password)
    {
        if ($this->config['auth_source'] == 'ldap') {
            require_once APP_PATH . DIRECTORY_SEPARATOR . 'include/ldap.php';

            $ldap = new LdapAuthentication();
            $result = $ldap->authenticate($username, $password);
        } else {
            $passwords = explode(
                '|',
                file(APP_PATH . DIRECTORY_SEPARATOR . DATA_DIR . DIRECTORY_SEPARATOR . 'passwd')
            );

            $result = isset($passwords[$username]) && $passwords[$username] == $password;
        }

        if ($result) {
            $_SESSION['username'] = $username;
        }

        return $result;
    }
}

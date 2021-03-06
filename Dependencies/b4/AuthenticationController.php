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
            require_once $this->config['app_path'] . '/include/ldap.php';

            $ldap = new LdapAuthentication();
            $result = $ldap->authenticate($username, $password);
        } else {
            $passwords = explode('|', file($this->config['app_path'] . '/' . $this->config['data_dir'] . '/passwd'));

            $result = isset($passwords[$username]) && $passwords[$username] == $password;
        }

        if ($result) {
            $_SESSION['username'] = $username;
        }

        return $result;
    }
}

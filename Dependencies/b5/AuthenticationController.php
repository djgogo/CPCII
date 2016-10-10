<?php
declare(strict_types = 1);

class AuthenticationController
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * @var LdapAuthentication
     */
    private $authentication;

    public function __construct(Configuration $config, LdapAuthentication $authentication)
    {
        $this->config = $config;
        $this->authentication = $authentication;
    }

    public function execute(string $username, string $password)
    {
        if ($this->config['auth_source'] == 'ldap') {
            require_once $this->config['app_path'] . '/include/ldap.php';
            $result = $this->authentication->authenticate($username, $password);
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

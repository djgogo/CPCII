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

    /**
     * @var Session
     */
    private $session;

    public function __construct(Configuration $config, LdapAuthentication $authentication, Session $session)
    {
        $this->config = $config;
        $this->authentication = $authentication;
        $this->session = $session;
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
            $this->session['username'] = $username;
        }

        return $result;
    }
}

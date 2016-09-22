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

    /**
     * @var \competec\Library\backends\FileBackend
     */
    private $fileBackend;

    public function __construct(Configuration $config, LdapAuthentication $authentication, Session $session, \competec\Library\backends\FileBackend $fileBackend)
    {
        $this->config = $config;
        $this->authentication = $authentication;
        $this->session = $session;
        $this->fileBackend = $fileBackend;
    }

    public function execute(string $username, string $password) : bool
    {
        if ($this->config['auth_source'] == 'ldap') {
            require_once $this->config['app_path'] . '/include/ldap.php';
            $result = $this->authentication->authenticate($username, $password);
        } else {
            $passwords = explode('|', $this->fileBackend->load($this->config['app_path'] . '/' . $this->config['data_dir'] . '/passwd'));
            $result = isset($passwords[$username]) && $passwords[$username] == $password;
        }

        if ($result) {
            $this->session['username'] = $username;
        }

        return $result;
    }
}

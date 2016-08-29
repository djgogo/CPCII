<?php
class UserRepository
{

    private $dom;
    private $xp;

    public function __construct(\DOMDocument $dom)
    {
        $this->dom = $dom;
        $this->xp = new \DOMXPath($dom);
    }

    /**
     * @param string $name
     * @return User
     */
    public function getUserByScreenName($name)
    {
        return $this->extractFromDom(sprintf("//user[@screenname='%s']", $this->quote($name)));
    }

    /**
     * @param string $name
     * @return User
     */
    public function getUserByRealName($name)
    {
        return $this->extractFromDom(sprintf('//user[@realname="%s"]', $this->quote($name)));
    }

    private function extractFromDom($xpath)
    {
        var_dump($xpath); exit;
        $userNode = $this->xp->query($xpath)->item(0);
        $user = new User(
            $userNode->getAttribute('id'),
            $userNode->getAttribute('realname'),
            $userNode->getAttribute('email')
        );
        $user->setScreenName($userNode->getAttribute('screenname'));
        return $user;
    }

    /**
     * xpath string handling xpath 1.0 "quoting"
     */
    public function quote(string $str) : string
    {
        if (strpos($str, '"') === false && strpos($str, "'") === false) {
            return $str;
        }

        if (strpos($str, '"') === false) {
            return '"' . $str . '"';
        }

        $parts = explode('"', $str);
        return 'concat("' . join('" , \'"\' , "', $parts) . '")';
    }
}

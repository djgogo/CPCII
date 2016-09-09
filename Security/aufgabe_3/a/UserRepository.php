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
        return $this->extractFromDom(sprintf("//user[@screenname='%s']", $name));
    }

    /**
     * @param string $name
     * @return User
     */
    public function getUserByRealName($name)
    {
        return $this->extractFromDom(sprintf('//user[@realname="%s"]', $name));
    }

    private function extractFromDom($xpath)
    {
        $userNode = $this->xp->query($xpath)->item(0);
        $user = new User(
            $userNode->getAttribute('id'),
            $userNode->getAttribute('realname'),
            $userNode->getAttribute('email')
        );
        $user->setScreenName($userNode->getAttribute('screenname'));
        return $user;
    }
}

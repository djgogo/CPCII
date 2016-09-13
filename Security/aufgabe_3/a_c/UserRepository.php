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
        $escapedName = $this->quote($name);
        return $this->extractFromDom(sprintf('//user[@screenname=%s]', $escapedName));
    }

    /**
     * @param string $name
     * @return User
     */
    public function getUserByRealName($name)
    {
        $escapedName = $this->quote($name);
        return $this->extractFromDom(sprintf('//user[@realname=%s]', $escapedName));
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

    /**
     * escape double quotes / taken from fDomXpath
     */
    public function quote($str) : string
    {
        if (strpos($str, '"') === false) {
            return '"' . $str . '"';
        }
        $parts = explode('"', $str);
        return 'concat("' . join('",\'"\',"', $parts) . '")';
    }

    /**
     * escape double and single quotes
     */
    function xQuote($str) : string
    {
        if (strpos($str, '"') === FALSE) {
            return '"' . $str . '"';
        }
        if (strpos($str, "'") === FALSE) {
            return "'" . $str . "'";
        }
        $parts = preg_split('/(")/', $str, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        array_walk(
            $parts,
            function (&$val) {
                if ($val == '"') $val = "'\"'";
                else $val = '"' . $val . '"';
            }
        );
        return 'concat(' . implode(',', $parts) . ')';
    }
}

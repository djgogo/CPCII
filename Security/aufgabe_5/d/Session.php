<?php
class Session
{
    private $store;

    private $data;
    private $sid;

    public function __construct(SessionStore $store)
    {
        $this->store = $store;
    }

    public function init(HttpRequest $request)
    {
        // Sicherheitsleck! SID über die Parameter einzulesen (link). XSS möglich und somit Session Fixation möglich.
//        if ($request->hasParameter('SID')) {
//            $this->sid = $request->getParameter('SID');
        if ($request->hasCookie('SID')) {
            $this->sid = $request->getCookie('SID');
        } else {
            $this->sid = $this->generateSessionId();
        }
        $this->data = $this->store->load($this->sid);
    }

    public function commit()
    {
        $this->store->save($this->sid, $this->escape($this->data));
    }

    public function getSessionId()
    {
        return $this->sid;
    }

    public function hasKey($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function setKey($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getKey($key)
    {
        if (!$this->hasKey($key)) {
            throw new RuntimeException($key . ' not set');
        }
        return $this->data[$key];
    }

    private function generateSessionId() : Token
    {
        return new Token();
    }

    public function escape($string) : string
    {
        return htmlspecialchars($string);
    }
}

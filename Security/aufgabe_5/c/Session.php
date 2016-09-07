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
        if ($request->hasParameter('SID')) {
            $this->sid = $request->getParameter('SID');
        } else if ($request->hasCookie('SID')) {
            $this->sid = $request->getCookie('SID');
        } else {
            $this->sid = $this->generateSessionId();
        }
        $this->data = $this->store->load($this->sid);
    }

    public function commit()
    {
        $this->store->save($this->sid, $this->data);
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
            throw new RuntimeException($key . ' net set');
        }
        return $this->data[$key];
    }

    private function generateSessionId() : Token
    {
        return new Token();
    }
}

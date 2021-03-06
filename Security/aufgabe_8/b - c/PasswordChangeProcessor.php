,<?php
class PasswordChangeProcessor implements ProcessorInterface
{
    private $gateway;

    public function __construct(UserTableDataGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    private function isAcceptable($password)
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match('/[a-zA-Z0-9.]/', $password)) {
            return false;
        }
        if (count(explode('.', $password)) != 1) {
            return false;
        }
        return true;
    }

    public function execute(HttpRequest $request)
    {
        $id = $request->getParameter('ID');
        $password = $request->getParameter('PASSWORD');

        if (!$this->isAcceptable($password)) {
            throw new RuntimeException('Given password does not satisfy all required rules');
        }

        if ($request->hasCookie('rememberme') && $request->hasCookie('remembermetoken')) {
            return new Url('/login');
        }

        try {
            $this->gateway->updatePassword($id, $password);
            return new Url('/password/change/success');
        } catch(Exception $e) {
            return new Url('/password/change/failed');
        }
    }
}

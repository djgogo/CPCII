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
        return true;
    }

    public function execute(HttpRequest $request)
    {
        $id = $request->getParameter('id');
        $password = $request->getParameter('password');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$this->isAcceptable($password)) {
            throw new RuntimeException('Given password does not satisfy all required rules');
        }
        try {
            $this->gateway->updatePassword($id, $hashedPassword);
            return new Url('/password/change/success');
        } catch(Exception $e) {
            return new Url('/password/change/failed');
        }
    }
}

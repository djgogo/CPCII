<?php

class SuxxCommentController implements SuxxController
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxCommentFormCommand
     */
    private $commentFormCommand;

    public function __construct(
        SuxxSession $session,
        SuxxCommentFormCommand $commentFormCommand)
    {
        $this->session = $session;
        $this->commentFormCommand = $commentFormCommand;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $result = $this->commentFormCommand->execute($request);

        if ($result === false) {
            header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);
        }

        $_SESSION = $this->session->getSessionData();
        header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);

    }
}

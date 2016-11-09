<?php

class SuxxCommentController implements SuxxController
{
    /**
     * @var SuxxSession
     */
    private $session;

    /**
     * @var SuxxCommentTableDataGateway
     */
    private $commentDataGateway;

    /**
     * @var SuxxFileBackend
     */
    private $backend;

    public function __construct(
        SuxxSession $session,
        SuxxCommentFormCommand $commentFormCommand,
        SuxxCommentTableDataGateway $commentDataGateway,
        SuxxFileBackend $backend)
    {
        $this->session = $session;
        $this->commentDataGateway = $commentDataGateway;
        $this->backend = $backend;
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

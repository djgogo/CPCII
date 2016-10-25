<?php

class SuxxCommentController implements SuxxController
{
    /**
     * @var SuxxCommentTableDataGateway
     */
    private $commentDataGateway;

    /**
     * @var SuxxFileBackend
     */
    private $backend;

    public function __construct(SuxxCommentTableDataGateway $commentDataGateway, SuxxFileBackend $backend)
    {
        $this->commentDataGateway = $commentDataGateway;
        $this->backend = $backend;
    }

    public function execute(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        unset($session->session['error']);

        $commentFormCommand = new SuxxCommentFormCommand($this->commentDataGateway, $request, $session, $this->backend);
        $commentFormCommand->validateRequest();

        if ($commentFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $commentFormCommand->performAction();
        }

        header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);
    }
}

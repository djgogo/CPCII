<?php

class SuxxCommentController implements SuxxController
{
    /**
     * @var SuxxCommentTableDataGateway
     */
    private $commentDataGateway;

    public function __construct(SuxxCommentTableDataGateway $commentDataGateway)
    {
        $this->commentDataGateway = $commentDataGateway;
    }

    public function execute(SuxxRequest $request, SuxxResponse $response)
    {
        $commentFormCommand = new SuxxCommentFormCommand($this->commentDataGateway, $request);
        $commentFormCommand->validateRequest();

        if ($commentFormCommand->hasErrors()) {
            // TODO $registrationFormCommand->repopulateform();
        } else {
            $commentFormCommand->performAction();
        }

        header('Location: /suxx/product?pid=' . $request->getValue('product'), 302);
    }

}

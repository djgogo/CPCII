<?php

abstract class SuxxAbstractFormCommand
{
    abstract public function execute(SuxxRequest $request);
    abstract protected function validateRequest();
    abstract protected function performAction();
    abstract protected function hasErrors();
    abstract protected function repopulateForm();
}


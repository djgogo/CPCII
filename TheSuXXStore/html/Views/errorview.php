<?php

class SuxxErrorView implements SuxxViewInterface
{
    public function render(SuxxRequest $request, SuxxResponse $response)
    {
        header('Content-type: text/plain');
        $output = "An Error occoured.\n";
        $output .= print_r($request, true);
        $output .= print_r($response, true);
        return $output;
    }
}

<?php


class BurgerConsoleRenderer implements BurgerRendererInterface
{
    /**
     * @param BurgerViewModel $viewModel
     * @return string
     */
    public function render(BurgerViewModel $viewModel) : string
    {
        $representation = sprintf("%s:\n", $viewModel->getName());
        $representation .= sprintf("-- Preis: %s\n", (string) $viewModel->getPrice());

        return $representation;
    }
}
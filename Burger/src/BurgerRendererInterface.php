<?php

interface BurgerRendererInterface
{
    /**
     * @param BurgerViewModel $viewModel
     * @return string
     */
    public function render(BurgerViewModel $viewModel) : string;
}
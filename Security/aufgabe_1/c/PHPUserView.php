<?php
class PHPUserView
{
    /**
     * @param UserView $userView
     * @return string
     */
    public function render(UserView $userView) : string
    {
        ob_start();
        include $this->getTemplateFileName();
        return ob_get_clean();
    }

    private function getTemplateFileName()
    {
        return __DIR__ . '/xhtml.php';
    }
}

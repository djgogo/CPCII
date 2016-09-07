<?php
class PHPUserView
{

    /**
     * @param User $user
     * @return string
     */
    public function render(User $user)
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

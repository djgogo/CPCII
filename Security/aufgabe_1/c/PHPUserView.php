<?php
class PHPUserView
{
    /**
     * @param User $user
     * @return string
     */
    public function render(User $user) : string
    {
        ob_start();
        $this->escape($user);
        include $this->getTemplateFileName();
        return ob_get_clean();
    }

    private function escape(User $user)
    {
        $user->setRealName(htmlspecialchars($user->getRealName()));
        $user->setScreenName(htmlspecialchars($user->getScreenName()));
        $user->setEmail(htmlspecialchars($user->getEmail()));
    }

    private function getTemplateFileName()
    {
        return __DIR__ . '/xhtml.php';
    }
}

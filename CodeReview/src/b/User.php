<?php
declare(strict_types = 1);

namespace CodeReview {

    class User
    {
        public function setId(int $id)
        {
            $this->id = $id;
        }
    }

    $userView = new User();
    $userView->setId(912367);

    var_dump($userView);
}

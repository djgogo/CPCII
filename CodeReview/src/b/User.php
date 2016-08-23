<?php
declare(strict_types = 1);

namespace CodeReview {

    class User
    {
        /**
         * @var int
         */
        private $id;

        public function setId(int $id)
        {
            $this->id = $id;
        }
    }

    $user = new User();
    $user->setId(912367);

    var_dump($user);
}

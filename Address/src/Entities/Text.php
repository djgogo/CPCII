<?php

namespace Adddress\Entities {

    class Text
    {
        /** @var int */
        private $id;

        /** @var string */
        private $text1;

        /** @var string */
        private $text2;

        /** @var string */
        private $created;

        /** @var string */
        private $updated;

        public function getId(): int
        {
            return $this->id;
        }

        public function getText1(): string
        {
            return $this->text1;
        }

        public function getText2(): string
        {
            return $this->text2;
        }

        public function getCreated(): string
        {
            return $this->created;
        }

        public function getUpdated(): string
        {
            return $this->updated;
        }
    }
}

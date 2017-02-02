<?php

namespace Address\Entities {

    class TextParameterObject
    {
        /** @var int */
        private $id;

        /** @var string */
        private $text1;

        /** @var string */
        private $text2;

        /** @var string */
        private $updated;

        public function __construct(int $id, string $text1, string $text2, string $updated)
        {
            $this->id = $id;
            $this->text1 = $text1;
            $this->text2 = $text2;
            $this->updated = $updated;
        }

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

        public function getUpdated(): string
        {
            return $this->updated;
        }
    }
}

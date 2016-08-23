<?php
declare(strict_types = 1);

namespace CodeReview\f
{
    class User
    {
        /**
         * @var string
         */
        private $name;

        /**
         * @var array
         */
        private $contracts = [];

        public function __construct(string $name)
        {
            $this->name = $name;
        }

        public function getName() : string
        {
            return $this->name;
        }

        public function addContract(Contract $contract)
        {
            $this->contracts[] = $contract;
        }
    }
}

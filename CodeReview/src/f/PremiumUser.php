<?php
declare(strict_types = 1);

namespace CodeReview\f
{
    class PremiumUser extends User
    {
//        public function addContract(SpecialContract $contract)
//        {
//            parent::addContract($contract);
//        }

        public function addSpecialContract(SpecialContract $contract)
        {
            parent::addContract($contract);
        }
    }
}

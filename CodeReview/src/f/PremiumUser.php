<?php
declare(strict_types = 1);

namespace CodeReview\f
{
    class PremiumUser extends User
    {
        public function addContract(Contract $contract)
        {
            parent::addContract($contract);
        }
    }
}

<?php
declare(strict_types = 1);

namespace Cart\Repositories
{
    use Cart\Voucher;

    interface VoucherRepositoryInterface
    {
        public function findVoucherById(int $id);
        public function addVoucher(Voucher $voucher);
    }
}

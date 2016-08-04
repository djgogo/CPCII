<?php
declare(strict_types = 1);

namespace Cart\Repositories
{
    use Cart\Exceptions\VoucherException;
    use Cart\Voucher;

    class VoucherRepository implements VoucherRepositoryInterface
    {
        /**
         * @var array
         */
        private $vouchers = [];

        public function findVoucherById(int $id) : Voucher
        {
            if (!isset($this->vouchers[$id])) {
                throw new VoucherException("Voucher with Id: $id not found!");
            }
            return $this->vouchers[$id];
        }

        public function addVoucher(Voucher $voucher)
        {
            $this->vouchers[] = $voucher;
        }
    }
}

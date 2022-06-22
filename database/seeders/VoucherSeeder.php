<?php

namespace Database\Seeders;

use App\Models\Product;
use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Database\Seeder;


class VoucherSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++) {
            $product = Product::find($i);
            $product->createVouchers(1, ['discount_percent' => 10], today()->addDays(7));
        }
    }
}

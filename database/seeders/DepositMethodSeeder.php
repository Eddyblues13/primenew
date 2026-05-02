<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DepositMethod;

class DepositMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bitcoin',
                'currency_code' => 'BTC',
                'type' => 'crypto',
                'wallet_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                'bank_details' => null,
                'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                'is_active' => true,
            ],
            [
                'name' => 'Ethereum',
                'currency_code' => 'ETH',
                'type' => 'crypto',
                'wallet_address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
                'bank_details' => null,
                'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
                'is_active' => true,
            ],
            [
                'name' => 'Tether',
                'currency_code' => 'USDT',
                'type' => 'crypto',
                'wallet_address' => 'T9yD14Nj9j7xAB4dbGeiX9h8unkKTrU7R2',
                'bank_details' => null,
                'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=T9yD14Nj9j7xAB4dbGeiX9h8unkKTrU7R2',
                'is_active' => true,
            ],
            [
                'name' => 'Bank Transfer',
                'currency_code' => 'USD',
                'type' => 'fiat',
                'wallet_address' => null,
                'bank_details' => "Bank Name: Prime Global Bank\nAccount Name: Prime Trade Access Inc.\nAccount Number: 1234567890\nRouting Number: 098765432",
                'qr_code_url' => null,
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            DepositMethod::create($method);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositMethod extends Model
{
    protected $fillable = [
        'name', 'currency_code', 'type', 'wallet_address', 'bank_details', 'qr_code_url', 'is_active'
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\Http\Traits\FilterTrait;


class Transaction extends Model
{
    use FilterTrait;

    const STATUS_NEW = 4;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_COMPLETED = 1;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    protected $fillable = [
        'type', 'amount', 'balance', 'account_id', 'description', 'created_at' , 'updated_at', 'user_id'
    ];



   /*
    public function getFamountAttribute()
    {
        return number_format($value, 2, ',', ' ');
    }

    public function getFbalanceAttribute($value)
    {
        return number_format($value, 2, ',', ' ');
    }


*/


}

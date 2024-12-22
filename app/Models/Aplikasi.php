<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aplikasi extends Model
{
    protected $table = 't_aplikasi';

    protected $primaryKey = 'apl_id';


    public function getRouteKeyName(): string
    {
        return 'uuid'; // Use the UUID column for route binding
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }

    public function negara(): BelongsTo
    {
        return $this->belongsTo(Negara::class, 'mfc_ctry', 'kdedi');
    }

    public function statusnya(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status', 'tab_code')->where('tab_name', '=', 'STATUS');
    }

    public function jenis_pengujian(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'jenis_uji', 'tab_code')->where('tab_name', '=', 'JENIS_UJI');
    }


}

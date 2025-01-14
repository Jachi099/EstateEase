<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MoveOutRequest extends Model
{
    protected $fillable = ['tenant_id', 'move_out_month', 'status'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}

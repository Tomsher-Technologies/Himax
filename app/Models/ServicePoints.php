<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class ServicePoints extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'title'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}

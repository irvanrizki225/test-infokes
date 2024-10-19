<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'folder_id',
        'last_seen',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}

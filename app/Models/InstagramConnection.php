<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class InstagramConnection extends Model
{
    protected $fillable = [
        'facebook_user_id',
        'facebook_page_id',
        'facebook_page_name',
        'instagram_business_account_id',
        'instagram_username',
        'access_token',
        'token_expires_at',
        'connected_by_user_id',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
    ];

    public function setAccessTokenAttribute($value): void
    {
        $this->attributes['access_token'] = Crypt::encryptString($value);
    }

    public function getAccessTokenAttribute($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function isConnected(): bool
    {
        return ! empty($this->instagram_business_account_id) && ! empty($this->access_token);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    const ACTIVE_MODE = 1;
    protected $table = 'links';

    protected $fillable = [
        'link', 'user_id', 'is_active',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public static function add($fields)
    {
        $link = new static;
        $link->fill($fields);
        $link->save();

        return $link;
    }
}

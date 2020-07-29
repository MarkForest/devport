<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const MIN = 1;
    const MAX = 1000;

    protected $table = 'games';

    protected $fillable = [
        'random', 'link_id',
    ];

    public static function calculate(int $random)
    {
        $amount = 0;
        if($random % 2 == 0) {
            if($random > 900) {
                //70%
                $amount = round(($random * 70)/100);
            } elseif ($random > 600) {
                //50%
                $amount = round(($random * 50)/100);
            } elseif ($random > 300) {
                //30%
                $amount = round(($random * 30)/100);
            } else {
                //10%
                $amount = round(($random * 10)/100);
            }
        }
        return $amount;
    }

    public function link()
    {
        return $this->hasOne(Link::class);
    }

    public static function add($fields)
    {
        $game = new static;
        $game->fill($fields);
        $game->save();

        return $game;
    }
}

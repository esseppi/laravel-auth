<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Coin extends Model
{
    public $timestamps = null;
    protected $fillable = [
        "name",
        "description",
        "thumb",
        "price",
        "amount"
    ];
    static public function generateSlug($originalStr)
    {
        $baseSlug = Str::of($originalStr)->slug('-');
        $slug = $baseSlug;
        $_i = 1;
        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }
}

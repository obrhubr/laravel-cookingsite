<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Ingredient extends Model
{
    /**
     * Get the Recipee that owns the ingredient.
     */
    public function recipee()
    {
        return $this->belongsTo(Recipee::class);
    }
}
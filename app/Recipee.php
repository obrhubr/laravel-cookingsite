<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Recipee extends Model
{
    /**
     * Get the Ingredients for the recipee post.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
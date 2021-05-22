<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ScoutElastic\Searchable;

class Recipee extends Model
{
    use Searchable;

    /**
     * @var string
     */
    protected $indexConfigurator = RecipeeIndexConfigurator::class;

    /**
     * @var array
     */
    protected $searchRules = [
        //
    ];

    /**
     * @var array
     */
    protected $mapping = [
        //
    ];
}
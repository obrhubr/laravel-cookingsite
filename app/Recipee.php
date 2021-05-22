<?php


namespace App;


use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;


class Recipee extends Model
{
    use Searchable;
    /**
     * Get the Ingredients for the recipee post.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    protected $indexConfigurator = RecipeeIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    // Here you can specify a mapping for model fields
    protected $mapping = [
        'properties' => [
            'name' => [
                'type' => 'text'
            ],
            'description' => [
                'type' => 'text'
            ],
            'ingredients' => [
                'type' => 'text',
                'fields' => [
                    'raw' => [
                        'type' => 'keyword',
                    ]
                ]
            ],
        ]
    ];
}
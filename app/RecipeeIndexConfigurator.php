<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class RecipeeIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    // It's not obligatory to determine name. By default it'll be a snaked class name without `IndexConfigurator` part.
    
    // You can specify any settings you want, for example, analyzers. 
    protected $settings = [
        'analysis' => [
            'analyzer' => [
                'es_std' => [
                    'type' => 'standard',
                    'stopwords' => '_english_'
                ]
            ]    
        ]
    ];
}
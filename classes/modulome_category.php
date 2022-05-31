<?php 

class modulome_category extends ObjectModel
{
    public static $definition = 
    [
        'table' => 'modulome_category',
        'primary' => 'id_modulome_category',
        'multilang' => false,
        'fields' => 
        [
            'cat_name' =>             
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ]
        ]
    ];
}
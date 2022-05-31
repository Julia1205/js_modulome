<?php 

class Maison extends ObjectModel
{
 
    public $modulome_cat_id;
    public $modulome_size;
    public $modulome_price;
    public $modulome_name;
    public $modulome_image;

    public static $definition = 
    [
        'table' => 'modulome',
        'primary' => 'id_modulome',
        'multilang' => false,
        'fields' => 
        [
            'modulome_cat_id' => 
            [
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true
            ],
            'modulome_size' => 
            [
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'required' => true
            ],
            'modulome_name' => 
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ],
            'modulome_price' =>
            [
                'type' => self::TYPE_INT,
                'validate' => 'isInt',
                'requred' => true
            ],
            'modulome_image' =>
            [
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHTML',
                'required' => true
            ]
        ]
    ];

    static function getSizes($catId)
    {
        $sql = new DbQuery();
        $sql->select('modulome_size')->from('modulome', 'fm')->where('modulome_cat_id = '.$catId);
        $result = Db::getInstance()->executeS($sql);
        return $result;
    }

    static function getPrice($size=0, $cat_id, $withSize=0)
    {
        $sql1 = new DbQuery();
        if ($withSize){
            $sql1->select('modulome_price')->from('modulome', 'fm')->where('modulome_cat_id = '.$cat_id.' AND modulome_size = '.$size);
        }else{
            $sql1->select('modulome_price')->from('modulome', 'fm')->where('modulome_cat_id = '.$cat_id);
        }
        $result = Db::getInstance()->executeS($sql1);
        return $result;
    }

    static function getBathroomsPrice($cat_id){
        $sql2 = new DbQuery();
        $sql2->select('modulome_price')->from('modulome', 'fm')->where('modulome_cat_id = '.$cat_id);
        $query = Db::getInstance()->getValue($sql2);
        //Tools::dieObject($query);
        return $query;
    }
}
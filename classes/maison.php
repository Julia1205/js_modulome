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

    static function getImage($size, $catId)
    {
        $sqlQuery = new DbQuery();
        $sqlQuery->select('modulome_image')->from('modulome', 'fm')->where('modulome_cat_id = '.$catId.' AND modulome_size = '.$size);
        return Db::getInstance()->getRow($sqlQuery);
    }

    static function getBathroomsPrice($cat_id){
        $sql2 = new DbQuery();
        $sql2->select('modulome_price')->from('modulome', 'fm')->where('modulome_cat_id = '.$cat_id);
        $query = Db::getInstance()->getValue($sql2);
        //Tools::dieObject($query);
        return $query;
    }

    static function getBedroomImg($size){
        $sql3 = new DbQuery();
        $sql3->select('modulome_image')->from('modulome')->where('modulome_cat_id = 4 AND modulome_size = '.$size);
        return Db::getInstance()->getValue($sql3);
    }

    static function getImageById($id)
    {
        $image = new maison($id);
        return $image->modulome_image;
    }

    static function getId($catId, $size){
        $query = new DbQuery();
        $query->select('id_modulome')->from('modulome', 'fm')->where('modulome_cat_id = '.$catId.' AND modulome_size = '.$size);
        $result = Db::getInstance()->executeS($size);
        Tools::dieObject($result);
        return $result;
    }
}
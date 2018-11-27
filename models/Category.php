<?php

class Category 
{
    public static function getCategoryList() {
        $dbPDO = DbConnector::getConnect();
        $result = $dbPDO->query('SELECT * FROM category WHERE status=1 ORDER BY id ASC');
        $categoryList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
}

<?php
include 'Entity/Item.php';
class ItemController{
    private $ItemList = [];

    public function __construct(){
        $this->ItemList = Item::getItems();
    }

    public function getitems(){
        return $this->ItemList;
    }

    public function updateItem($id,$itemName,$category,$price,$vis)
    {
        $temp = new Item($id);
        $temp->update($itemName,$category,$price,$vis);
    }

    public function addItem($itemName,$category,$price)
    {
        Item::add($itemName,$category,$price);
    }

    public function getVisibleItems()
    {
        $result = Item::getVisibleItems();
        return $result;
    }

}
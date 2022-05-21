<?php
class Item{
    private $conn;
    private $id;
    private $name;
    private $category;
    private $price;
    private $img;
    private $visibility;

    public  function __construct($id)
    {
        $this->conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from `item` where `ITEM ID` = $id";
        $result = $this->conn->query($sql);

        $row = $result->fetch_assoc();
        $this->id = $row["ITEM ID"];
        $this->name = $row["ITEM NAME"];
        $this->category = $row["CATEGORY"];
        $this->price = $row["PRICE"];
        $this->img =  $row["IMAGEURL"];
        $this->visibility = $row["VISIBLE"];

    }

    static public function getItems()
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from `item`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while ($row=$result->fetch_assoc())
                {
                    $transArr[] = array('item id' => $row["ITEM ID"],'item name' => $row["ITEM NAME"], 'category'
                    => $row["CATEGORY"], 'price' => $row["PRICE"], 'imageurl' => $row["IMAGEURL"],
                    'visible' => $row["VISIBLE"]);
                }
        }
        return $transArr;
    }

    static public function getVisibleItems()
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from `item` where `visible` = true";
        $result = $conn->query($sql);
        return $result;
    }

    public function update($itemName,$category,$price,$vis)
    {
        $sql = "update `item` set `ITEM NAME` = '$itemName', 
            `CATEGORY` = '$category', `PRICE` = $price , `VISIBLE` = $vis
             where `ITEM ID` = $this->id";
        $this->conn->query($sql);
    }

    static public function add($itemName,$category,$price)
    {
        $conn = new mysqli("localhost", "root", "", "restaurant");
        $sql = "INSERT INTO `item` ( `ITEM NAME`, `CATEGORY`, `PRICE`, `IMAGEURL`, `VISIBLE`) VALUES
        ( '$itemName', '$category', $price, 'images/basic.png', 1)";
        $conn->query($sql);
    }
} 
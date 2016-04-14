<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/19/2016
 * Time: 3:09 AM
 */

include_once('adb.php');

class Item extends Adb
{
    /**
     * @param $sf
     * @param $np
     * @return bool|mysqli_result
     */
    public function allItems($sf, $np)
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id LIMIT $sf,$np";
        return $this->query($query);
    }

    public function allItemTest()
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        return $this->query($query);
    }

    public function getAllItems()
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        return $this->query($query);
    }

    public function getItemBrands($brand)
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id AND b.brand_name=?";
        $s = $this->prepare($query);
        $s->bind_param('s', $brand);
        $s->execute();
        return $s->get_result();
    }

    public function countItems()
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    public function countItemBrand($brand)
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id AND brand_name='$brand'";
        $r = $this->query($query);
        $no = mysqli_num_rows($r);
        return $no;
    }

    public function getItemDetails($id)
    {
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id AND s.item_id = ?";
        $s = $this->prepare($query);
        $s->bind_param('i', $id);
        $s->execute();
        return $s->get_result();
    }

    public function updateItem($id, $qty, $nb)
    {
        $query = "UPDATE items SET qty=?,num_bought=? WHERE item_id=?";
        $s = $this->prepare($query);
        $s->bind_param('iii', $qty, $nb, $id);
        $s->execute();
    }

    public function updateCustomer($f, $l, $em, $a, $ci, $c, $p)
    {
        $query = "UPDATE `customer` SET firstname=?,lastname=?,email=?,address=?,city=?,country=?,phone=? WHERE email =?";
        $s = $this->prepare($query);
        $s->bind_param('ssssssss', $f, $l, $em, $a, $ci, $c, $p, $em);
        $s->execute();
    }

    public function makeCustomer($f, $l, $em, $a, $ci, $c, $p, $ib)
    {
        $query = "INSERT INTO customer(firstname,lastname, email, address, city, country, phone,items_bought) VALUES (?,?,?,?,?,?,?,?)";
        $s = $this->prepare($query);
        $s->bind_param('ssssssss', $f, $l, $em, $a, $ci, $c, $p, $ib);
        $s->execute();
    }

    public function getCustomerDetails($email)
    {
        $query = "SELECT cust_id FROM customer WHERE email = ?";
        $s = $this->prepare($query);
        $s->bind_param('s', $email);
        $s->execute();
        return $s->get_result();
    }

    public function getCustomerEmail($email)
    {
        $query = "SELECT email FROM customer WHERE email =?";
        $s = $this->prepare($query);
        $s->bind_param('s', $email);
        $s->execute();
        return $s->get_result();
    }

    public function makeOrder($cid)
    {
        $query = "INSERT INTO orders(cust_id) VALUES (?)";
        $s = $this->prepare($query);
        $s->bind_param('i', $cid);
        $s->execute();
    }

    public function getItemsBought($email)
    {
        $query = "SELECT items_bought FROM customer WHERE email=?";
        $s = $this->prepare($query);
        $s->bind_param('s', $email);
        $s->execute();
        return $s->get_result();
    }

    public function getBrands()
    {
        $query = "SELECT * FROM brand";
        return $this->query($query);
    }

    public function search($name)
    {
        $new_name = '%' . $name . '%';
        $query = "SELECT * FROM items s INNER JOIN brand b WHERE s.brand_id = b.brand_id AND s.item_name LIKE ?";
        $s = $this->prepare($query);
        $s->bind_param('s', $new_name);
        $s->execute();
        return $s->get_result();
    }

    public function allCountries()
    {
        $query = "SELECT * FROM countries_ph";
        return $this->query($query);
    }

    public function getPhoneCode($iso)
    {
        $query = "SELECT phonecode FROM countries_ph WHERE iso3 = ?";
        $s = $this->prepare($query);
        $s->bind_param('s', $iso);
        $s->execute();
        return $s->get_result();
    }

    public function report($id,$num)
    {
        $query = "INSERT INTO item_bought(item_id, num_bought) VALUES (?,?)";
        $s = $this->prepare($query);
        $s->bind_param('ii', $id,$num);
        $s->execute();
    }
}
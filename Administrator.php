<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/30/2016
 * Time: 10:42 PM
 */
include_once 'adb.php';
include_once 'Mail.php';

class Administrator extends Adb
{
    public function getAllItems()
    {
        $query = "SELECT s.item_id, s.item_name,s.qty, s.price, b.brand_name from items s inner join brand b on s.brand_id = b.brand_id ORDER by s.item_id ASC";

        return $this->query($query);
    }

    public function update($name, $qty, $price, $id)
    {
        $query = "UPDATE items SET item_name=?,qty=?,price=? WHERE item_id=?";
        $s = $this->prepare($query);
        $s->bind_param('siii', $name, $qty, $price, $id);
        $s->execute();
    }

    public function orders()
    {
        $query = "SELECT o.order_id,o.date, c.email,c.address,c.country from orders o INNER JOIN customer c where o.cust_id = c.cust_id AND o.confirmed = 0 ORDER BY o.date ASC";
        return $this->query($query);
    }

    public function getCustomerDetails($id)
    {
        $query = "SELECT c.firstname,c.lastname,c.email,o.date from customer c inner join orders o WHERE c.cust_id = o.cust_id AND o.order_id=?";
        $s = $this->prepare($query);
        $s->bind_param('i', $id);
        $s->execute();
        return $s->get_result();
    }

    public function confirmOrder($id)
    {
        $query = "UPDATE orders SET confirmed = 1 WHERE order_id=?";
        $s = $this->prepare($query);
        $s->bind_param('i', $id);
        $s->execute();

    }

    public function report()
    {
        $query = "SELECT s.skirt_name,b.brand_name,s.num_bought FROM skirts s INNER  JOIN brand b on s.brand_id = b.brand_id;";
        return $this->query($query);
    }

    public function itemSum()
    {
        $query = "SELECT SUM(s.num_bought) as total FROM skirts s INNER JOIN brand b on s.brand_id = b.brand_id";
        $num = $this->query($query);
        return $num;
    }

    public function getCountry($iso)
    {
        $query = "SELECT nicename FROM countries_ph WHERE iso3 = ?";
        $s = $this->prepare($query);
        $s->bind_param('s', $iso);
        $s->execute();
        return $s->get_result();
    }

    public function generateReport($date)
    {
        $new_date = '%' . $date . '%';
        $query = "SELECT s.item_id,s.item_name,sum(i.num_bought), i.time FROM item_bought i INNER JOIN items s on i.item_id= s.item_id WHERE i.time LIKE ? GROUP BY s.item_name ORDER BY time asc";
        $s = $this->prepare($query);
        $s->bind_param('s', $new_date);
        $s->execute();
        return $s->get_result();
    }

    public function login($username, $password)
    {
        $query = "SELECT admin_name,admin_pass FROM admin WHERE admin_name=? AND admin_pass=?";
        $s = $this->prepare($query);
        $s->bind_param('ss', $username, $password);
        $s->execute();
        return $s->get_result();
    }
}
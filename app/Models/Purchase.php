<?php

namespace App\Models;

use App\config\DatabaseConfig;
use App\utilities\Common;

class Purchase extends DatabaseConfig
{

    public $request;


    public function insert($request)
    {
        $this->request = $request;

        try {
            $stmt = $this->conn->prepare("INSERT INTO `product_sell`(amount,buyer,receipt_id,items,buyer_email,buyer_ip,note,city,phone,hash_key,entry_at,entry_by) VALUES (:amount,:buyer,:receipt_id,:items,:buyer_email,:buyer_ip,:note,:city,:phone,:hash_key,:entry_at,:entry_by)");

            $items = '';
            foreach ($this->request->get('items') as $key => $item) {
                $items .= $item . ', ';
            }
            $data = [
                'amount' => $this->request->get('amount'),
                'buyer' => $this->request->get('buyer'),
                'receipt_id' => $this->request->get('receipt_id'),
                'items' => $items,
                'buyer_email' => $this->request->get('buyer_email'),
                'buyer_ip' => Common::getUserIP(),
                'note' => $this->request->get('note'),
                'city' => $this->request->get('city'),
                'phone' => $this->request->get('phone'),
                'hash_key' => hash('sha512', $this->request->get('receipt_id')),
                'entry_at' => date('Y-m-d'),
                'entry_by' => $this->request->get('entry_by'),
            ];


            $stmt->execute($data);

        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }

        return 'Created successfully';
    }


    public function getAll()
    {


        $stmt = $this->conn->prepare("select * from product_sell");
        $stmt->execute();

        return $result = $stmt->fetchAll();


    }


}

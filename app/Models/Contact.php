<?php


namespace App\Models;


use App\System\Model;
use App\System\Request;
use App\Utilities\Common;
use Exception;
use PDOException;

class Contact extends Model
{

    protected $table = 'contacts';


    public function insert(Request $request)
    {

        try {
            $stmt = $this->connection->prepare("INSERT INTO  {$this->table}(amount,buyer,receipt_id,items,buyer_email,buyer_ip,note,city,phone,hash_key,entry_at,entry_by) VALUES (:amount,:buyer,:receipt_id,:items,:buyer_email,:buyer_ip,:note,:city,:phone,:hash_key,:entry_at,:entry_by)");

            $items = '';
            foreach ($request->get('items') as $key => $item) {
                $items .= $item.', ';
            }

            $data = [
                'amount' => $request->get('amount'),
                'buyer' => $request->get('buyer'),
                'receipt_id' => $request->get('receipt_id'),
                'items' => $items,
                'buyer_email' => $request->get('buyer_email'),
                'buyer_ip' => Common::getUserIP(),
                'note' => $request->get('note'),
                'city' => $request->get('city'),
                'phone' => $request->get('phone'),
                'hash_key' => hash('sha512', $request->get('receipt_id')),
                'entry_at' => date('Y-m-d'),
                'entry_by' => $request->get('entry_by'),
            ];


            $stmt->execute($data);

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

        return 'Created successfully';
    }


}

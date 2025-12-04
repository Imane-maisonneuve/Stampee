<?php

namespace App\Models;

use App\Models\CRUD;

class Auction extends CRUD
{
    protected $table = 'auction';
    protected $primaryKey = 'id';
    protected $fillable = ['date_start', 'date_end', 'price_floor', 'current_bid_amount', 'is_lord_s_favorite', 'stamp_id'];

    // Requete specifique pour recuperer les encheres d'un utilisateur
    public function getAuctions($value)
    {
        $sql = "SELECT S.name, date_end, price_floor, current_bid_amount 
                FROM stamp S INNER JOIN auction A ON S.id = A.stamp_id
                INNER JOIN user_bid UB ON A.id = UB.auction_id
                WHERE UB.user_id = :$value";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$value", $value);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

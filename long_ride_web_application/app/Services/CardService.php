<?php

namespace App\Services;

use App\Models\Card;

class CardService
{
    public function getAllCardData($data)
    {
        $result = Card::when(isset($data['cardName']) && $data['cardName'] != '', function($q) use($data) {
            return $q->where('card.cardName', $data['cardName']);
        })

        ->orderBy('cardId','DESC')
        ->get();
        return $result;
    }

    public function getAllCards(){
        $result = Card::get();
        return $result;
    }
}

?>

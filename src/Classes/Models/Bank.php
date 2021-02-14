<?php


class Bank
{
    public function getBankIdentification($bin){
        $bankId = file_get_contents('https://lookup.binlist.net/' . $bin);
        if (!$bankId)
            die('error!');
        return json_decode($bankId);
    }
}
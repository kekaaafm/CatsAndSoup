<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Values extends Model
{

    public $timestamps = false;
    public $dataset = [];

    public function __construct($v)
    {
        foreach ($v as $d){
            $this->dataset[$d->date][$d->user] = max($d->value,$this->dataset[$d->date][$d->user]??0);
        }

        $counter = 0;
        foreach ($this->dataset as $key => $value){

            $prev = $this->previous($counter);
            if(!isset($value["Marketing"])) $value["Marketing"] = $prev["Marketing"];
            if(!isset($value["Syleam"])) $value["Syleam"] = $prev["Syleam"];
            $value["date"] = $key;
            $value["diff_tot"] = $value['Syleam'] - $value['Marketing'];


            if ($counter != 0) {
                $value["gain_veille"] = $prev["diff_tot"] - $value['diff_tot'];
                $value["gain_syleam"] = $prev["Syleam"] - $value["Syleam"];
                $value["gain_marketing"] = $prev["Marketing"] - $value["Marketing"];
                $value["eta"] = ($value["Syleam"] - $value['Marketing']) / ($value["gain_marketing"] - $value["gain_syleam"]);
            }

            if($counter > 2) {
                $value["moy_3d_syleam"] = ($value["Syleam"] + $prev['Syleam'] + $this->previous($counter-1)["Syleam"]) / 3;
                $value["moy_3d_marketing"] = ($value["Marketing"] + $prev['Marketing'] + $this->previous($counter-1)["Marketing"]) / 3;
                $value["eta_3d"] = ($value["Syleam"] - $value['Marketing']) / ($value["moy_3d_marketing"] - $value["moy_3d_syleam"]);
            }
            $this->dataset[$key] = $value;
            $counter++;
//            dump($this->previousWithDate($key));
//            dump($value);
        }
//        die;
        return $this;
    }

    public function getDate(int $index){
        return array_keys($this->dataset)[$index];
    }

    public function previous(int $index,){
        if($index === 0) return null;
        return $this->dataset[$this->getDate($index-1)]??$this->previous($index-1);
    }

    public function previousWithDate(string $date){
        return $this->previous(array_search($date, array_keys($this->dataset)));
    }
}

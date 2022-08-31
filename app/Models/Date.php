<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Date extends Model
{
    use HasFactory;

    public Carbon $date;
    private array $syleam = [];
    private array $marketing = [];

    public function __construct(Carbon $date)
    {
        $this->date = $date->copy();

        $results = DB::table('values')
            ->select("*")
            ->where("date", "=", $date->toDateString())
            ->orderBy("value", "ASC")
            ->get();

        foreach ($results as $result){
            switch ($result->user){
                case "Syleam":
                    $this->syleam[] = $result;
                    break;
                case "Marketing":
                    $this->marketing[] = $result;
                    break;
                default:
                    throw new \Exception('Typo in "'.$result->user.'", does not match ["Marketing", "Syleam"]');
                    break;
            }

        }
    }
    public function getLevel(string $user, bool $bigger = true): ?int
    {
        if(!$this->$user) return null;
        if(count($this->$user) === 0) return null;
        return ($this->$user[count($this->$user)-1])->value;
    }

    public function getMarketingLevel(): ?int
    {
        return $this->getLevel("marketing");
    }

    public function getSyleamLevel(): ?int
    {
        return $this->getLevel("syleam");
    }

    public function getFormattedDate(): string
    {
        return $this->date->toDateString();
    }

    public function isSyleamHigher(): bool{
        return $this->getSyleamLevel()>$this->getMarketingLevel();
    }
}

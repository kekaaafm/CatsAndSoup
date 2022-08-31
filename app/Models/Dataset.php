<?php

namespace App\Models;

use Brick\Math\Exception\DivisionByZeroException;
use Carbon\Carbon;
use DivisionByZeroError;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dataset extends Model
{

    public $timestamps = false;

    /**
     * @var array of multiple Date objects
     */
    private array $dataset = [];
    protected int $pointer = 0;

    public function __construct(Carbon $date, int $offset = 20)
    {
        $r = DB::table('values')
            ->select("date")
            ->where("date", "<=", $date->toDateString())
            ->groupBy("date")
            ->get();

        $date = new Carbon($r[$r->count() - 1]->date ?? now());

        for ($i = 0; $i <= $offset; $i++) {
            if ($i > 0) $date->subDay();
            $this->addToDataset(new Date($date), $date);
        }
//        dd($this);
        return $this;
    }

    private function addToDataset(Date $item)
    {
        $this->dataset[$item->date->toDateString()] = $item;
    }

    public function getFromDataset(Carbon $key): ?Date
    {
        return $this->dataset[$key->toDateString()] ?? null;
    }

    public function getDataset(): array
    {
        return $this->dataset;
    }

    public function getFallbackValue(Carbon $date, string $user): ?int
    {
        $fallback = ($this->getFromDataset($date));
        if ($fallback === null) return null;
        if ($fallback->getLevel(strtolower($user)) === null) return $this->getFallbackValue($date->copy()->subDay(), $user);
        return $fallback->getLevel(strtolower($user));
    }

    public function getFallbackValues(Carbon $date): ?array
    {
        return [
            "syleam" => $this->getFallbackValue($date, "syleam"),
            "marketing" => $this->getFallbackValue($date, "marketing")
        ];
    }

    public function getYesterdayValue(Carbon $date, string $user): ?int
    {
        return $this->getFallbackValue($date->copy()->subDay(), $user);
    }

    public function getYesterdayValues(Carbon $date)
    {
        return $this->getFallbackValues($date->copy()->subDay());
    }

    public function getDiff(Carbon $date): ?int
    {
        if ($this->getFallbackValue($date, "syleam") === null && $this->getFallbackValue($date, "marketing") === null) return null;
        return $this->getFallbackValue($date, "syleam") - $this->getFallbackValue($date, "marketing");
    }

    public function gainVeille(Carbon $date): ?int
    {
        if ($this->getDiff($date->copy()->subDay()) === null) return null;
        return $this->getDiff($date) - $this->getDiff($date->copy()->subDay());
    }

    public function gainUser(Carbon $date, string $user): ?int
    {
        if ($this->getYesterdayValue($date, $user) === null) return null;
        return $this->getFallbackValue($date, $user) - $this->getYesterdayValue($date, $user);
    }

    public function eta(Carbon $date): ?int
    {
        if ($this->gainUser($date, "syleam") === null or $this->gainUser($date, "marketing") === null) return null;
        return $this->getDiff($date) / -($this->gainVeille($date));
    }

    public function getAverage(Carbon $date, string $user, int $avr = 3): ?int
    {
        $tot = 0;
        for ($i = 0; $i < $avr; $i++) {
            $d = $this->gainUser($date->copy()->subDays($i), $user);
            if ($d === null) return null;
            $tot += $this->gainUser($date->copy()->subDays($i), $user);
        }
        return $tot / $avr;
    }

    public function etaWithAverage(Carbon $date, int $avr = 3): ?int
    {
        if ($this->getAverage($date, "syleam") === null or $this->getAverage($date, "marketing") === null) return null;
        if (($this->getAverage($date, "syleam") - $this->getAverage($date, "marketing")) == 0) return null;
        return $this->getDiff($date) / ($this->getAverage($date, "marketing") - $this->getAverage($date, "syleam"));
    }

}

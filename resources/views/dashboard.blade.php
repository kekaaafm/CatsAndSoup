<?php
/**
 * @var Date $value
 * @var Dataset $dataset
 * @var $loop
 * */

use App\Models\Dataset;
use App\Models\Date;

$tot = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Cats&Soup Tracker"/>
    <meta charset="utf-8">
    <title>Cats&Soup Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <meta name="author" content="Marc">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    {{--    <script src="http://code.jquery.com/jquery-latest.min.js"></script>--}}
</head>

<body class="hack dark-grey" style="padding: 0 10rem;text-align: center;">

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Syleam</th>
        <th>Marketing</th>
        <th>Gain veille</th>
        <th>Diff tot</th>
        <th></th>
        <th>Gain Syleam</th>
        <th>Gain Mark</th>
        <th></th>
        <th>Moy 3j Syleam</th>
        <th>Moy 3j Mark</th>
        <th></th>
        <th>Estimation (1j)</th>
        <th>Estimation (3j)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataset->getDataset() as $value)
        <?php
        $tot += $dataset->gainVeille($value->date) ?? "0";
        //            dump($tot)
        ?>
        <tr>
            <td>{{ $value->getFormattedDate() }}</td>
            <td style="color: @if($dataset->getFallbackValue($value->date, "syleam")>$dataset->getFallbackValue($value->date, "marketing")) #2ca02c @endif">{{ $dataset->getFallbackValue($value->date, "syleam")??"-" }}</td>
            <td style="color: @if($dataset->getFallbackValue($value->date, "syleam")<$dataset->getFallbackValue($value->date, "marketing")) #2ca02c @endif">{{ $dataset->getFallbackValue($value->date, "marketing")??"-" }}</td>
            <td style="color: @if(($dataset->gainVeille($value->date)??0)<0) #2ca02c @elseif($dataset->gainVeille($value->date)) #AA3333 @endif">{{ $dataset->gainVeille($value->date)??"-" }}</td>
            <td>{{ $dataset->getDiff($value->date)??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td style="color: @if($dataset->gainUser($value->date, "syleam")>$dataset->gainUser($value->date, "marketing")) #2ca02c @endif">{{ $dataset->gainUser($value->date, "syleam")??"-" }}</td>
            <td style="color: @if($dataset->gainUser($value->date, "syleam")<$dataset->gainUser($value->date, "marketing")) #2ca02c @endif">{{ $dataset->gainUser($value->date, "marketing")??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td style="color: @if($dataset->getAverage($value->date, "syleam")>$dataset->getAverage($value->date, "marketing")) #2ca02c @endif">{{ $dataset->getAverage($value->date, "syleam")??"-" }}</td>
            <td style="color: @if($dataset->getAverage($value->date, "syleam")<$dataset->getAverage($value->date, "marketing")) #2ca02c @endif">{{ $dataset->getAverage($value->date, "marketing")??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td style="color: @if($dataset->eta($value->date)<0) #AA3333 @elseif($dataset->eta($value->date)) #2ca02c  @endif">{{ $dataset->eta($value->date)??"-" }}</td>
            <td {{--style="color: @if(isset($value['eta_3d']) and $value['eta_3d']<0) #AA3333 @endif"--}}>{{ $dataset->etaWithAverage($value->date)??"-" }}</td>
        </tr>
    @endforeach
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td style=" color: @if($tot<0) #2ca02c @else #AA3333 @endif">{{ $tot }}</td>
            {{--        <td style="color: @if($values->gainsTotaux<0) #2ca02c @else #AA3333 @endif">{{ $values->gainsTotaux }}</td>--}}
        </tr>
    </tbody>
</table>

</body>
</html>

<?php
/**
 * @var array $values
 * @var $loop
 * */
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
    @foreach($values->dataset as $value)
        <tr>
            <td>{{ $value['date'] }}</td>
            <td style="color: @if($value['Syleam']>$value['Marketing']) #2ca02c @endif">{{ $value['Syleam'] }}</td>
            <td style="color: @if($value['Syleam']<$value['Marketing']) #2ca02c @endif">{{ $value['Marketing'] }}</td>
            <td style="color: @if(($value['gain_veille']??0)<0) #2ca02c @elseif(isset($value['gain_veille'])) #AA3333 @endif">{{ $value['gain_veille']??"-" }}</td>
            <td>{{ $value['diff_tot'] }}</td>
            <td></td> {{-- Empty --}}
            <td style="color: @if(isset($value['gain_syleam']) && $value['gain_syleam']>$value['gain_marketing']) #2ca02c @endif">{{ $value['gain_syleam']??"-" }}</td>
            <td style="color: @if(isset($value['gain_syleam']) && $value['gain_syleam']<$value['gain_marketing']) #2ca02c @endif">{{ $value['gain_marketing']??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td>{{ isset($value['moy_3d_syleam'])?round($value['moy_3d_syleam'],2):"-" }}</td>
            <td>{{ isset($value['moy_3d_marketing'])?round($value['moy_3d_marketing'],2):"-" }}</td>
            <td></td> {{-- Empty --}}
            <td style="color: @if(isset($value['eta']) and $value['eta']<0) #AA3333 @endif">{{ isset($value['eta'])?round($value['eta'],2):"-" }}</td>
            <td style="color: @if(isset($value['eta_3d']) and $value['eta_3d']<0) #AA3333 @endif">{{ isset($value['eta_3d'])?round($value['eta_3d'],2):"-" }}</td>
        </tr>
    @endforeach
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td style="color: @if($values->gainsTotaux<0) #2ca02c @else #AA3333 @endif">{{ $values->gainsTotaux }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>

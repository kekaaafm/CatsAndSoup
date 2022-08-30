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
        <th>Diff tot</th>
        <th>Gain veille</th>
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
            <td>{{ $value['Syleam'] }}</td>
            <td>{{ $value['Marketing'] }}</td>
            <td>{{ $value['diff_tot'] }}</td>
            <td>{{ $value['gain_veille']??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td>{{ $value['gain_syleam']??"-" }}</td>
            <td>{{ $value['gain_marketing']??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td>{{ $value['moy_3d_syleam']??"-" }}</td>
            <td>{{ $value['moy_3d_marketing']??"-" }}</td>
            <td></td> {{-- Empty --}}
            <td>{{ $value['eta']??"-" }}</td>
            <td>{{ $value['eta_3d']??"-" }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

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
        <th>Moy 1j Syleam</th>
        <th>Moy 1j Mark</th>
        <th></th>
        <th>Moy 3j Syleam</th>
        <th>Moy 3j Mark</th>
        <th></th>
        <th>Estimation (1j)</th>
        <th>Estimation (3j)</th>
    </tr>
    </thead>
    <tbody>
        @for($i=0;$i<5;$i++)
        <tr>
            <td>19/08</td>
            <td style="color: #2ca02c">6062</td>
            <td>2170</td>
            <td>3892</td>
            <td>-</td>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td></td>
            <td>-</td>
            <td>-</td>
        </tr>
        @endfor
    </tbody>
</table>

</body>
</html>

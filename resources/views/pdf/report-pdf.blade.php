<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport</title>
    <style>
        @page { margin: 0px; }
        body{ background-color: #2A3165;color: white; font-family: Arial, sans-serif;margin: 0px; }
        h2{
            font-size: 28px;
            color: white;
            margin-bottom: 20px;
        }
        table{
            width: 100%;padding-left: 15px;padding-right: 15px;
            border-spacing: 30px;
        }
        td{
            text-align: center;margin-left: auto;margin-right: auto; border: 1px solid white;
            border-radius: 25px;
            padding: 20px 10px;
            vertical-align: top;
        }
        img{ width:100%; }
    </style>
</head>
<body>
    <table >
        <caption>
            <h1 style="font-size: 32px">Rapport de satisfaction des interventions en milieu scolaire Adhéos du {{date('d-m-Y')}} </h1>
        </caption>

        <tr>
            <td style="text-align: center;margin-left: auto;margin-right: auto;width: 50%; border: 1px solid white; border-radius: 25px ">
                <h2>{{$title1}}</h2>
                <img  src="{!! $data1 !!}" alt="" />
            </td>
            <td style="text-align: center;margin-left: auto;margin-right: auto;width: 50%;">
                <h2>{{$title2}}</h2>
                <img  src="{!! $data2 !!}" alt="" />
            </td>
        </tr>
        <tr>
            <td style="text-align: center;margin-left: auto;margin-right: auto;width: 50%;">
                <h2>{{$title3}}</h2>
                <img  src="{!! $data3 !!}" alt="" />
            </td>
            <td style="text-align: center;margin-left: auto;margin-right: auto;width: 50%;">
                <h2>{{$title4}}</h2>
                <img  src="{!! $data4 !!}" alt="" />
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;margin-left: auto;margin-right: auto;">
                <h2>{{$title5}}</h2>
                <img  src="{!! $data5 !!}" alt="" />
            </td>

        </tr>
    </table>

    <div style="text-align:center; width: 100%; margin: auto; color: white; margin-top: 5px; font-size: 14px;">
        Adhéos association LGBTI & friendly <br>
        5, passage Ancienne Caserne<br>
        17100 Saintes <br>
        Tél : 06 26 39 66 13 - web : https://www.adheos.org
    </div>

</body>
</html>

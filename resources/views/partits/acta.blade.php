<!DOCTYPE html>
<html>

<head>
    <title>Acta del Partit</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .resultat-box {
            border: 1px solid #000;
            padding: 20px;
            text-align: center;
            background-color: #f0f0f0;
        }

        .teams {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .team {
            display: table-cell;
            width: 45%;
            vertical-align: middle;
            text-align: center;
        }

        /* Ajustamos el tamaño de la puntuación para que quepa bien */
        .score-container {
            display: table-cell;
            width: 10%;
            vertical-align: middle;
            text-align: center;
        }

        .score {
            font-size: 35px;
            font-weight: bold;
            white-space: nowrap;
        }

        .details {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Acta Oficial de Partit</h1>
        <p>Federació de Futbol Femení</p>
    </div>

    <div class="resultat-box">
        <div class="teams">
            <div class="team">
                {{-- Nombre Local --}}
                <h2>{{ $partit->local->nom ?? 'Local' }}</h2>
                <p>(Local)</p>
            </div>

            <div class="score-container">
                <span class="score">
                    {{-- AQUI EL CAMBIO: Usamos 'resultat' directamente --}}
                    @if($partit->resultat && $partit->resultat !== '-')
                    {{ $partit->resultat }}
                    @else
                    - vs -
                    @endif
                </span>
            </div>

            <div class="team">
                {{-- Nombre Visitante --}}
                <h2>{{ $partit->visitant->nom ?? 'Visitant' }}</h2>
                <p>(Visitant)</p>
            </div>
        </div>
    </div>

    <div class="details">
        <h3>Detalls del Partit</h3>
        <table>
            <tr>
                <th>Data i Hora</th>
                <td>{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Estadi</th>
                <td>{{ $partit->estadi->nom ?? 'No assignat' }}</td>
            </tr>
            <tr>
                <th>Ciutat</th>
                <td>{{ $partit->estadi->ciutat ?? ($partit->local->ciutat ?? '-') }}</td>
            </tr>
            <tr>
                <th>Estat</th>
                {{-- Lógica actualizada: si hay resultado, está finalizado --}}
                <td>{{ ($partit->resultat && $partit->resultat !== '-') ? 'Finalitzat' : 'Pendent' }}</td>
            </tr>
        </table>
    </div>

    <div class="details">
        <h3>Signatures</h3>
        <br><br><br>
        <div style="width: 100%;">
            <div style="float: left; width: 45%; border-top: 1px solid black; text-align: center; padding-top: 5px;">
                Capità Local
            </div>
            <div style="float: right; width: 45%; border-top: 1px solid black; text-align: center; padding-top: 5px;">
                Capità Visitant
            </div>
        </div>
    </div>

</body>

</html>
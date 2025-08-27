<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Aniversariantes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .left {
            width: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .center {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .right {
            width: 100px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
        }

        .logo {
            height: 50px;
            object-fit: contain;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .date {
            font-size: 12px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }

        /* th {
            background-color: #f0f0f0;
        } */
    </style>
</head>
<body>
    <table>
        <thead>
            <!-- Linha com logo e data -->
            <tr>
                <th style="text-align: left; border: none;" colspan="2">
                    <img src="{{ public_path('imagens/LOGO_AVECAD.png') }}" alt="Logo" style="height: 40px;">
                </th>
                <th style="border:none"></th>
                <th style="text-align: right; font-size: 12px; border: none; font-weight: normal;" colspan="2">
                    Emitido em:
                    {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </th>
            </tr>

            <!-- Linha do título centralizado -->
            <tr>
                <th colspan="5" style="text-align: center; font-size: 18px; font-weight: bold; border: none; padding-bottom: 10px;">
                    Relatório de Aniversariantes do mês de {{ ucfirst(now()->translatedFormat('F')) }}
                </th>
            </tr>
            <tr style="background-color: #f0f0f0;">
                <th></th>
                <th>Associado</th>
                <th>Apelido</th>
                <th>Data Nascimento</th>
                <th>Idade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($associates as $associate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $associate->name }}</td>
                    <td>{{ $associate->surname }}</td>
                    <td>{{ \Carbon\Carbon::parse($associate->birth_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($associate->birth_date)->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

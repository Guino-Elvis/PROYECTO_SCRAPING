<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>resporte PDF</title>
</head>
<style>
    th,
    td {
        padding: 2px;
        border: 1px solid #ccc;
    }
    th {
        background-color: #e4e4e4;
    }
</style>

<body>

    <h1 class="text-center mb-2">REPORTE DE EMPRESAS</h1>

    <div class="mb-2">
        <span class="text-xs mr-2">Total: {{ $total }} Postulantes</span>

        <span class="text-xs mr-2">Fecha: {{ $date }}</span>
        <span class="text-xs">Hora: {{ $hour }}</span>
    </div>

    <table>
        <thead>
            <tr class="text-center text-xs font-bold uppercase">
                <th class="px-2">ID</th>
                <th class="px-2">titulo</th>
                <th class="px-2">remuneracion</th>
                <th class="px-2">ubicacion</th>
                <th class="px-2">descripcion</th>
                <th class="px-2">fecha_inicio</th>
                <th class="px-2">fecha_fin</th>
                <th class="px-2">limite_postulante</th>
                <th class="px-2">state</th>
                <th class="px-2">Empresa</th>
                <th class="px-2">Usuario</th>
                <th class="px-2">Fecha de creacion</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ofertaLaborals as $item)
                <tr class="text-xs text-gray-600">
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="px-2 text-center">{{ $item->titulo }}</td>
                    <td class="px-2">{{ $item->remuneracion }}</td>
                    <td class="px-2">{{ $item->ubicacion }}</td>
                    <td class="px-2">{{ $item->descripcion }}</td>
                    <td class="px-2">{{ $item->body }}</td>
                    <td class="px-2">{{ $item->fecha_inicio }}</td>
                    <td class="px-2">{{ $item->fecha_fin }}</td>
                    <td class="px-2">{{ $item->limite_postulante }}</td>
                    <td class="px-2">{{ $item->state }}</td>
                    <td class="px-2">{{ $item->empresa->ra_social }}</td>

                    <td class="px-2">{{ $item->user->name }}</td>
                    <td class="px-2">{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

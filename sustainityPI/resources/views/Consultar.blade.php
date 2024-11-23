<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Creado el</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($consultaCuentas as $cuenta)
                    <tr>
                        <td>{{ $cuenta->id }}</td>
                        <td>{{ $cuenta->correo }}</td>
                        <td>{{ $cuenta->contraseña }}</td>
                        <td>{{ $cuenta->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay datos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
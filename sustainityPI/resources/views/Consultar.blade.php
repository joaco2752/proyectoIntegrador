<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @session('exito')
        <script>
            Swal.fire({
                title: "Datos actualizados con éxito",
                icon: "success"
            });
        </script>
    @endsession
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Usuarios</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Creado el</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($consultaCuentas as $cuenta)
                    <tr>
                        <td>{{ $cuenta->id }} </td>
                        <td>{{ $cuenta->email }} </td>
                        <td>{{ $cuenta->created_at }} </td>
                        <td>
                            <form>
                                <a href="{{ route('rutaFormConsulta', ['id' => $cuenta->id]) }}"
                                    class="btn btn-warning btn-sm">
                                    {{ __('Actualizar') }}
                                </a>
                            </form>
                        </td>
                        <td>
                            <form id="delateform{{$cuenta->id}}" action="{{ route('rutaEliminar', ['id' => $cuenta->id]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmarcuenta({{$cuenta->id}})">
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay datos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('rutaInicio') }}" class="btn btn-primary btn-sm">
            {{ __('Salir') }}
        </a>
    </div>
    <script>
        function confirmarcuenta(usuarioid) {
            Swal.fire({
                title: "Quieres eliminar el usuario?",
                showCancelButton: true,
                confirmButtonText: "Eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delateform${usuarioid}`).submit();
                }
            });
        }
    </script>
</body>

</html>
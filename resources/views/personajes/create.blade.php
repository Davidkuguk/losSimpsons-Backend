<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimpsonsDex | Registrar personaje</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f7d51d;
            color: #212529;
        }

        .page {
            width: min(92%, 760px);
            margin: 0 auto;
            padding: 40px 0;
        }

        .panel {
            background: #fff;
            border: 3px solid #212529;
            border-radius: 8px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.18);
            padding: 28px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 32px;
        }

        p {
            margin-top: 0;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #999;
            border-radius: 6px;
            padding: 10px;
            font-size: 16px;
        }

        button {
            width: 100%;
            border: 0;
            border-radius: 6px;
            padding: 12px 16px;
            background: #212529;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }

        .alert {
            border-radius: 6px;
            margin-bottom: 20px;
            padding: 14px;
        }

        .alert-success {
            background: #d1e7dd;
            border: 1px solid #badbcc;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
        }

        .error {
            margin-top: 6px;
            color: #b00020;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="panel">
            <h1>SimpsonsDex</h1>
            <p>Registro de personajes del universo Los Simpsons.</p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Revisa el formulario:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('personajes.store') }}">
                @csrf

                <div class="field">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ejemplo: Homer Simpson"
                    >
                    @error('nombre')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo">
                        <option value="">Selecciona un tipo</option>
                        <option value="Familiar" @selected(old('tipo') === 'Familiar')>Familiar</option>
                        <option value="Amigo" @selected(old('tipo') === 'Amigo')>Amigo</option>
                        <option value="Jefe" @selected(old('tipo') === 'Jefe')>Jefe</option>
                        <option value="Vecino" @selected(old('tipo') === 'Vecino')>Vecino</option>
                        <option value="Otro" @selected(old('tipo') === 'Otro')>Otro</option>
                    </select>
                    @error('tipo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="color_pelo">Color de pelo</label>
                    <input
                        type="text"
                        id="color_pelo"
                        name="color_pelo"
                        value="{{ old('color_pelo') }}"
                        placeholder="Ejemplo: Azul"
                    >
                    @error('color_pelo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="trabajo">Trabajo</label>
                    <input
                        type="text"
                        id="trabajo"
                        name="trabajo"
                        value="{{ old('trabajo') }}"
                        placeholder="Ejemplo: Inspector de seguridad"
                    >
                    @error('trabajo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Registrar personaje</button>
            </form>
        </section>
    </main>
</body>
</html>

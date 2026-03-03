<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // 1. Leer el archivo JSON
    $archivo = 'usuarios.json';
    if (!file_exists($archivo)) {
        file_put_contents($archivo, json_encode([]));
    }
    
    $contenidoActual = file_get_contents($archivo);
    $listaUsuarios = json_decode($contenidoActual, true);

    // 2. Agregar el nuevo correo
    $nuevoUsuario = array(
        "email" => $email,
        "fecha" => date("d-m-Y H:i:s")
    );
    $listaUsuarios[] = $nuevoUsuario;

    // 3. Guardar
    file_put_contents($archivo, json_encode($listaUsuarios, JSON_PRETTY_PRINT));

    // 4. Mostrar mensaje de éxito bonito
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>¡Registro Exitoso!</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: "Inter", sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background: #f4f9f4; }
            .card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center; max-width: 400px; }
            h1 { color: #2D6A4F; margin-bottom: 10px; }
            p { color: #555; }
            .loader { border: 4px solid #f3f3f3; border-top: 4px solid #007AFF; border-radius: 50%; width: 30px; height: 30px; animation: spin 2s linear infinite; margin: 20px auto; }
            @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        </style>
        <meta http-equiv="refresh" content="3;url=index.html">
    </head>
    <body>
        <div class="card">
            <h1>¡Todo listo! ✅</h1>
            <p>Gracias por unirte a <strong>Study Mind AI</strong>. Hemos guardado tu correo: <b>' . htmlspecialchars($email) . '</b></p>
            <p><small>Redirigiendo a la página principal...</small></p>
            <div class="loader"></div>
        </div>
    </body>
    </html>';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokemon</title>
    <link rel="stylesheet" type="text/css" href="examen.css">
</head>

<body>

    <header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

    <div></div>

    <nav><a href='G1.php'> G1 Kanto &nbsp;&nbsp;</a> <a href='G2.php'>G2 Johto &nbsp;&nbsp;</a><a href='G3.php'> G3 Hoenn &nbsp;&nbsp;</a><a href='G4.php'> G4 Sinnoh &nbsp;&nbsp;</a><a href='G5.php'> G5 Unova &nbsp;&nbsp;</a><a href='G6.php'> G6 Kalos &nbsp;&nbsp;</a><a href='G7.php'> G7 Alola &nbsp;&nbsp;</a><a href='G8.php'> G8 Galar &nbsp;&nbsp;</a><a href='G9.php'> G9 Paldea &nbsp;&nbsp;</a><a href='buscar.php'>Búsqueda &nbsp;&nbsp;</a></nav>
    <div id="iniciales">
        <div id="ficha">
            <?php


            if (isset($_GET['pokemon'])) {
                $pokemonName = $_GET['pokemon'];

                $ch = curl_init();
                $url = "https://pokeapi.co/api/v2/pokemon/$pokemonName";
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $respuesta = curl_exec($ch);
                curl_close($ch);

                $valores = json_decode($respuesta, true);

                if ($valores !== null) {
                    // Contenedor div para el nombre y la imagen

                    echo '<div style="text-align: center; margin: 10px; height: 150px; width: 150px;">';

                    // Mostrar la imagen del Pokémon
                    if (isset($valores['sprites']['front_default'])) {
                        echo '<img src="' . $valores['sprites']['front_default'] . '" alt="' . $pokemonName . '">';
                    } else {
                        echo 'Imagen no disponible<br>';
                    }

                    // Mostrar el nombre del Pokémon
                    echo '<p>' . $pokemonName . '</p>';

                    // Cerrar el contenedor div
                    echo '</div>';
                } else {
                    echo 'Error al obtener detalles del Pokémon ' . $pokemonName . '<br>';
                }
            } else {
                echo 'No se proporcionó un nombre de Pokémon válido.';
            }
            $chDetalles = curl_init();
            $urlDetalles = $valores['species']['url'];
            curl_setopt($chDetalles, CURLOPT_URL, $urlDetalles);
            curl_setopt($chDetalles, CURLOPT_RETURNTRANSFER, TRUE);
            $respuestaDetalles = curl_exec($chDetalles);
            curl_close($chDetalles);

            $detalles = json_decode($respuestaDetalles, true);

            // Mostrar las habilidades del Pokémon
            if (isset($detalles['flavor_text_entries'])) {
                echo '<h4>Habilidades:</h4>';
                echo '<ul>';
                foreach ($detalles['flavor_text_entries'] as $entry) {
                    if ($entry['language']['name'] === 'es') { // Seleccionar texto en español
                        echo '<li>' . $entry['flavor_text'] . '</li>';
                    }
                }
                echo '</ul>';
            } else {
                echo 'No se encontraron habilidades para este Pokémon.<br>';
            }
            $chTipo = curl_init();
            $urlTipo = $valores['types'][0]['type']['url'];
            curl_setopt($chTipo, CURLOPT_URL, $urlTipo);
            curl_setopt($chTipo, CURLOPT_RETURNTRANSFER, TRUE);
            $respuestaTipo = curl_exec($chTipo);
            curl_close($chTipo);

            $tipo = json_decode($respuestaTipo, true);


            $chTipo = curl_init();
            $urlTipo = $valores['types'][0]['type']['url'];
            curl_setopt($chTipo, CURLOPT_URL, $urlTipo);
            curl_setopt($chTipo, CURLOPT_RETURNTRANSFER, TRUE);
            $respuestaTipo = curl_exec($chTipo);
            curl_close($chTipo);

            $tipo = json_decode($respuestaTipo, true);

            // Mostrar el tipo del Pokémon
            if (isset($tipo['names'])) {
                echo '<h4>Tipo:</h4>';
                echo '<ul>';
                foreach ($tipo['names'] as $name) {
                    if ($name['language']['name'] === 'es') { // Seleccionar texto en español
                        echo '<li>' . htmlspecialchars($name['name']) . '</li>';
                    }
                }
                echo '</ul>';
            } else {
                echo 'No se encontró información de tipo para este Pokémon.<br>';
            }

            // Cerrar el contenedor div
            echo '</div>';

            ?>

        </div>
    </div>
    <div class="abajo"></div>

    <footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra
        Perenxisa.</footer>

</body>

</html>
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

    <nav><a href='index.php'> Inicio &nbsp;&nbsp;</a><a href='G1.php'> G1 Kanto &nbsp;&nbsp;</a> <a href='G2.php'>G2 Johto &nbsp;&nbsp;</a><a href='G3.php'> G3 Hoenn &nbsp;&nbsp;</a><a href='G4.php'> G4 Sinnoh &nbsp;&nbsp;</a><a href='G5.php'> G5 Unova &nbsp;&nbsp;</a><a href='G6.php'> G6 Kalos &nbsp;&nbsp;</a><a href='G7.php'> G7 Alola &nbsp;&nbsp;</a><a href='G8.php'> G8 Galar &nbsp;&nbsp;</a><a href='G9.php'> G9 Paldea &nbsp;&nbsp;</a><a href='buscar.php'>Búsqueda &nbsp;&nbsp;</a></nav>
    <div id="iniciales">
        <?php


        $ch = curl_init();
        $url = 'https://pokeapi.co/api/v2/pokemon?offset=810&limit=89';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $respuesta = curl_exec($ch);
        curl_close($ch);

        $valores = json_decode($respuesta, true);


        if ($valores !== null && isset($valores['results'])) {
            echo '<div style="display: flex; flex-wrap: wrap;">';
            foreach ($valores['results'] as $pokemon) {
                // Obtener detalles del Pokémon
                $chDetalle = curl_init();
                $urlDetalle = $pokemon['url'];
                curl_setopt($chDetalle, CURLOPT_URL, $urlDetalle);
                curl_setopt($chDetalle, CURLOPT_RETURNTRANSFER, TRUE);
                $respuestaDetalle = curl_exec($chDetalle);
                curl_close($chDetalle);

                $detallePokemon = json_decode($respuestaDetalle, true);

                if ($detallePokemon !== null) {
                    // Contenedor div para el nombre y la imagen
                    echo '<div style="text-align: center; margin: 10px; height: 150px; width: 150px;">'; // Ajustar el ancho y agregar margen

                    // Mostrar la imagen del Pokémon
                    if (isset($detallePokemon['sprites']['front_default'])) {
                        echo '<a href="ficha.php?pokemon=' . $pokemon['name'] . '">';
                        echo '<img src="' . $detallePokemon['sprites']['front_default'] . '" alt="' . $pokemon['name'] . '">';
                        echo '</a>';
                    } else {
                        echo 'Imagen no disponible<br>';
                    }

                    // Mostrar el nombre del Pokémon
                    echo '<p>' . $pokemon['name'] . '</p>';

                    // Cerrar el contenedor div
                    echo '</div>';
                } else {
                    echo 'Error al obtener detalles del Pokémon ' . $pokemon['name'] . '<br>';
                }
            }
        }
        ?>

        <div class="abajo"></div>

        <footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>

</body>

</html>
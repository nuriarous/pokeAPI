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
    <main id="iniciales">
        <form method="POST">
            <fieldset>
                <input type="radio" name="busqueda" id="nombre" value="nombre">
                <label for="nombre">Nombre
                </label>

                <input type="radio" name="busqueda" id="tipo" value="tipo">
                <label for="tipo">Tipo</label>

                <input type="radio" name="busqueda" id="region" value="region">
                <label for="region">Región</label>


                <label for="consulta">
                    <p>Introduce tu búsqueda:
                </label>
                <input type="text" id="consulta" name="consulta" required>


                <input type="submit" value="Buscar">
            </fieldset>
        </form>


        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $consulta = $_POST['consulta'];
            $busqueda = $_POST['busqueda'];

            if ($busqueda == 'nombre') {
                $ch = curl_init();
                $url = "https://pokeapi.co/api/v2/pokemon/$consulta";
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $respuesta = curl_exec($ch);
                curl_close($ch);

                $valores = json_decode($respuesta, true);

                if ($valores !== null) {
                    // Contenedor div para el nombre y la imagen

                    echo '<div style="text-align: center; margin-bottom: 100px; height: 150px; width: 150px;">';

                    // Mostrar la imagen del Pokémon
                    if (isset($valores['sprites']['front_default'])) {
                        echo '<img src="' . $valores['sprites']['front_default'] . '" alt="' . $consulta . '">';
                    } else {
                        echo 'Imagen no disponible<br>';
                    }

                    // Mostrar el nombre del Pokémon
                    echo '<p>' . $consulta . '</p>';

                    // Cerrar el contenedor div
                    echo '</div>';
                } else {
                    echo 'Error al obtener detalles del Pokémon ' . $consulta . '<br>';
                }
            }


            if ($busqueda == 'tipo') {
                $urlTipo = "https://pokeapi.co/api/v2/type/$consulta";
                $chTipo = curl_init();
                curl_setopt($chTipo, CURLOPT_URL, $urlTipo);
                curl_setopt($chTipo, CURLOPT_RETURNTRANSFER, TRUE);
                $respuestaTipo = curl_exec($chTipo);
                curl_close($chTipo);

                $tipo = json_decode($respuestaTipo, true);

                // Mostrar los Pokémon del tipo especificado
                if (isset($tipo['pokemon'])) {
                    echo '<h4>Pokémon del tipo ' . $consulta . ':</h4>';
                    echo '<ul>';
                    foreach ($tipo['pokemon'] as $pokemonTipo) {
                        $urlPokemon = $pokemonTipo['pokemon']['url'];
                        $chPokemon = curl_init();
                        curl_setopt($chPokemon, CURLOPT_URL, $urlPokemon);
                        curl_setopt($chPokemon, CURLOPT_RETURNTRANSFER, TRUE);
                        $respuestaPokemonTipo = curl_exec($chPokemon);
                        curl_close($chPokemon);

                        $pokemonTipo = json_decode($respuestaPokemonTipo, true);

                        if ($pokemonTipo !== null) {
                            // Contenedor div para el nombre y la imagen
                            echo '<div style="text-align: center; margin: 10px; height: 150px; width: 150px; float:left;">'; // Ajustar el ancho y agregar margen

                            // Mostrar la imagen del Pokémon
                            if (isset($pokemonTipo['sprites']['front_default'])) {
                                echo '<img src="' . $pokemonTipo['sprites']['front_default'] . '" alt="' . $pokemonTipo['name'] . '">';
                            } else {
                                echo 'Imagen no disponible<br>';
                            }
                            // Mostrar el nombre del Pokémon
                            echo '<p>' . $pokemonTipo['name'] . '<p>';
                            echo '</div>';
                        } else {
                            echo 'No se encontró información de Pokémon para este tipo.<br>';
                        }
                    }
                }
            }

            if ($busqueda == 'region') {
                switch ($consulta) {
                    case 'G1 Kanto':
                        header('location: G1.php');
                        break;
                    case 'G2 Johto':
                        header('location: G2.php');
                        break;
                    case 'G3 Hoenn':
                        header('location: G3.php');
                        break;
                    case 'G4 Sinnoh':
                        header('location: G4.php');
                        break;
                    case 'G5 Unova':
                        header('location: G5.php');
                        break;
                    case 'G6 Kalos':
                        header('location: G6.php');
                        break;
                    case 'G7 Alola':
                        header('location: G7.php');
                        break;
                    case 'G8 Calar':
                        header('location: G8.php');
                        break;
                    case 'G9 Paldea':
                        header('location: G9.php');
                        break;
                    default:
                        echo 'Ha habido un error';
                        break;
                }
            }
        }
        ?>

        </div>

        <footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2023/2024 IES Serra Perenxisa.</footer>

</body>

</html>
<?php
require 'vendor/autoload.php';

include "view.php";

if( isset($_POST["getInformationAction"]) ) {

    // 1. Get id from form
    $id = $_POST['identifiant'];

    if( !empty($id) ) {

        // 2. Make document url
        $url = 'http://dx.doi.org/'.$id;

        // 3. Make RDF graph
        $rdf = generateRDF($url);
        $graph = new EasyRdf_Graph($url, $rdf, 'turtle');
        
        /*
        ------- Debug -------
        echo '<pre>';        
        var_dump($graph);
        ---------------------
        */

        // 4. Get title & date
        $title = $graph->get($url, "dcterms:title", "literal", null); // Return a literal node
        $date = $graph->get($url, "dcterms:date", "literal", null); // Return a literal node

        // 5. Show result
        echo '<div class="result">';
        echo '<h2>Résultat pour l\'id ' . $id . ' :</h2>';
        if( !empty($title) && !empty($date) ) {
            echo '<div class="result__url"><a href="' . $url . '" target="_blank" class="url">' . $title . '</a><span>'.$date.'</span></div>';

            // Search authors...
            $creators = $graph->all($url, "dcterms:creator", "resource", null); // Return a resource node
            if( !empty($creators) ) {
                $authorText = count($creators) > 1 ? "auteurs trouvés" : "auteur trouvé";
                echo '<h2>' . count($creators) . ' ' . $authorText . '</h2>';
                echo '<ul class="authors">';
                foreach($creators as $creator) {
                    echo '<li>' . $creator->label() . '</li>';
                }
                echo '</ul>';
            } else {
                $errors['authors'] = 'Aucun auteur trouvé.';
            }
        } else {
            $errors['id_wrong'] = 'Aucun résultat pour cet id. Veuillez réessayer.';
        }
        echo '</div>';

    } else {
        $errors['id_empty'] = "Vous devez indiquer un ID";
    }

    // Show errors...
    if(isset($errors)) {
        foreach($errors as $key => $error) {
            echo "<ul class='error'><li style='color:red;'><b>Erreur </b> : ".$error."</li></ul>";
        }
    }

}


/*
 * Return RDF ready to create graph
 * @param  string  $url The url of resource
 */
function generateRDF($url) {
    $ch = curl_init();
    $headers = array();
    $headers[] = "Accept: text/turtle";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);

    return $result;
}
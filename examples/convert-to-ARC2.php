<?php

// Inspired by http://blog.literarymachine.net/?p=5

require_once('arc/ARC2.php');

require_once('LibRDF/LibRDF.php');

// All models, i.e. graphs, reside in a storage. This defaults to
// memory.
$store = new LibRDF_Storage();

/* We could as well load the data from a triple store instead of fetching it from the Web
$store = new LibRDF_Storage("postgresql", "richard.cyganiak.de",
        "new='no',
        host='localhost',
        database='tests',
        user='postgres',
        password='whatever'");
*/

$model = new LibRDF_Model($store);
$model->loadStatementsFromURI(
        new LibRDF_Parser('rdfxml'),
        'http://richard.cyganiak.de/foaf.rdf');


$triples=$model->toArc2Triples();

$parser = ARC2::getRDFParser();

$turtle_doc = $parser->toTurtle($triples);

print($turtle_doc);


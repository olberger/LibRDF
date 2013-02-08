<?php

// Inspired by http://blog.literarymachine.net/?p=5

require_once('arc/ARC2.php');

require_once('LibRDF/LibRDF.php');

// Create a new PostGreSQL storage. The second parameter is NOT the
// name of the PostGreSQL database to use, but the name of the
// triplestore. This makes it possible to create several
// triplestores within one database. The third parameter is
// a string containing the options for the actual PostGreSQL database.
// They should speak for themselves, except for "new='no'". It will
// reuse an existing saved model (see fetch-and-save.php for the script
// which initializes the DB and populates the model)

$store = new LibRDF_Storage("postgresql", "richard.cyganiak.de",
        "new='no',
        host='localhost',
        database='tests',
        user='postgres',
        password='whatever'");

$model = new LibRDF_Model($store);

// Now that the model has been retrieved from the DB, let's convert it
// to ARC2 internat triples structure

$triples=$model->toArc2Triples();

$parser = ARC2::getRDFParser();

// And serialize it to Turtle

$turtle_doc = $parser->toTurtle($triples);

print($turtle_doc);


<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
try {
    $dbh = new PDO('sqlite:/home/devnewton/fossils/b3.fossil', '', '');
Header('Content-type: text/xml');
	$xml = new XMLWriter;
	$xml->openURI('php://output');
	$xml->startDocument('1.0', 'UTF-8');
	$xml->startElement('board');
    	foreach($dbh->query('select objid, strftime("%Y%m%d%H%M%S",mtime) as norloge, user, bgcolor, comment from event order by objid desc') as $row) {
		$xml->startElement('post');
		$xml->writeAttribute('id', $row['objid']);
		$xml->writeAttribute('time', $row['norloge']);
		$xml->startElement('info');
		$user = $row['user'];
		if(empty($user)) {
			$user = $row['bgcolor'];
		}
		$xml->text($user);
		$xml->endElement();
		$xml->startElement('login');
		$xml->endElement();
		$xml->startElement('message');
		$xml->text($row['comment']);
		$xml->endElement();
		$xml->endElement();
	}
	$xml->endElement();
	$dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

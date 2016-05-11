<?php
session_start();

include('./bin/class/structure.php');

$tipo = $_REQUEST['tipo'];
$id = $_REQUEST['id'];

$structure = new Structure;


if(empty($tipo) || empty($id)){
	//header("Location: index.php");
}elseif(strcmp($tipo,"xml") == 0){
	$receita = $structure->buscaReceita($id);
	print_r($receita);

	// creating object of SimpleXMLElement
	$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

	array_to_xml($receita,$xml_data);

	echo $xml_data->asXML();

}elseif(strcmp($tipo,"json") == 0){
	$receita = $structure->buscaReceita($id);
	echo json_encode($receita);
}





function array_to_xml( $data, &$xml_data ) {
	print_r($xml_data);
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
}
<?php
session_start();

include('./bin/class/structure.php');

$tipo = $_REQUEST['tipo'];
$id = $_REQUEST['id'];

$structure = new Structure;
$export_XML = new Export_XML;


if(empty($tipo) || empty($id)){
	//header("Location: index.php");
}elseif(strcmp($tipo,"xml") == 0){
	$receita = $structure->buscaReceita($id);

	$xml = new ArrayObject();
	$xml->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);

	$xml['receita']['class'] = $receita->class;
	$xml['receita']['id'] = $receita->id;
	$xml['receita']['name'] = $receita->name;
	$xml['receita']['totalTime'] = $receita->totalTime;
	$xml['receita']['recipeYield'] = $receita->recipeYield;
	$xml['receita']['aggregateRating'] = $receita->aggregateRating;
	$xml['receita']['ingredients'] = $receita->ingredients->default;
	$xml['receita']['instructions'] = $receita->ingredients->default;


	$export_XML->array_to_xml($xml);
	//$xml = $export_XML->array_to_xml($xml);

	echo $xml->asXML();

}elseif(strcmp($tipo,"json") == 0){
	$receita = $structure->buscaReceita($id);
	echo json_encode($receita);
}





class Export_XML{

	public function array_to_xml( $data ) {

		$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

	    foreach( $data as $key => $value ) {
	        if( is_array($value) ) {
	            if( is_numeric($key) ){
	                $key = 'item'.$key; //dealing with <0/>..<n/> issues
	            }
	            $subnode = $xml_data->addChild($key);
	            array_to_xml($value, $subnode);
	        } else {
	           	echo $key."=>".$value."<br>";
	           	$xml_data->addChild("$key",htmlspecialchars("$value"));
	        }
	    }
	    return $xml_data;
	}
}

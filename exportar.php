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

	$xml = '<?xml version="1.0" encoding="UTF-8"?>';
	$xml .= '<receita>';
	$xml .=  '*%'.'<class>'.$receita->class.'</class>';
	$xml .=  '*%'.'<id>'.$receita->id.'</id>';
	$xml .=  '*%'.'<name>'.$receita->name.'</name>';
	$xml .=  '*%'.'<totalTime>';
		$xml .=  '*%'.'<dateTime>'.$receita->totalTime->dateTime.'</dateTime>';
		$xml .=  '*%'.'<human>'.$receita->totalTime->human.'</human>';
	$xml .=  '*%'.'</totalTime>';
	$xml .=  '*%'.'<recipeYield>';
		$xml .=  '*%'.'<value>'.$receita->recipeYield->value.'</value>';
		$xml .=  '*%'.'<human>'.$receita->recipeYield->human.'</human>';
	$xml .=  '*%'.'</recipeYield>';
	$xml .=  '*%'.'<aggregateRating>';
		$xml .=  '*%'.'<ratingCount>'.$receita->aggregateRating->ratingCount.'</ratingCount>';
		$xml .=  '*%'.'<ratingValue>'.$receita->aggregateRating->ratingValue.'</ratingValue>';
		$xml .=  '*%'.'<bestRating>'.$receita->aggregateRating->bestRating.'</bestRating>';
		$xml .=  '*%'.'<worstRating>'.$receita->aggregateRating->worstRating.'</worstRating>';
	$xml .=  '*%'.'</aggregateRating>';
	$xml .=  '*%'.'<images>';
		foreach ($receita->images as $key => $value) {
			$xml .=  '*%'.'<image>'.$value->link.'</image>';
		}
	$xml .=  '*%'.'</images>';
	$xml .=  '*%'.'<ingredients>';
		foreach ($receita->ingredients->default as $key => $value) {
			$xml .=  '*%'.'<ingredient>'.$value.'</ingredient>';
		}
	$xml .=  '*%'.'</ingredients>';
	$xml .=  '*%'.'<instructions>';
		foreach ($receita->instructions->default as $key => $value) {
			$xml .=  '*%'.'<instruction>'.$value.'</instruction>';
		}
	$xml .=  '*%'.'</instructions>';
	$xml .=  '</receita>';

	$xml = str_replace('<', '&lt;', $xml);
	$xml = str_replace('>', '&gt;', $xml);
	$xml = str_replace('*%', '<br>', $xml);
	echo $xml;
}elseif(strcmp($tipo,"json") == 0){
	$receita = $structure->buscaReceita($id);
	echo  json_encode($receita);
}
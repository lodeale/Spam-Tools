<?php
	include("toolSpam.php");
	/*
	 *  Vamos a mostrar un ejemplo de como podemos:
	 *  1) construir un mensaje para enviar.
	 * 	2) Como depurar un archivo para sacar todo lo que no sea un archivo.
	 *  3) Como sacar los duplicados.
	 * 	4) Como salvar un archivo ya depurado
	 *  5) Testear un archivo ya depurado de la cantidad de archivos.
	 *  @abstract
	 *  @author Dario Alejandro Zapiola
	 * 
	 */
	//1) 
	//$prueba = new mensaje();
	//$prueba->header();
	/*
	 *  @param string $archivo el archivo que queremos enviar 
	 * 
	 */ 
	//$prueba->construir("lodeale@gmail.com","lodeale@hotmail.com","alejandro","Prueba","");
	/*
	 *  @method object enviar() Para enviar el correo construido anteriormente
	 */
	//$prueba->enviar();*/
	//2)
	$depuramos = new depurar("correo.txt");
	$depuramos->basura();
	$depuramos->duplicado();
	$depuramos->saveFile();
	depurar::testCantidad("correoClear.spam");
?>

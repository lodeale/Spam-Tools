<?php
	class email{
		protected $user;
		protected $dominio;
		function __construct($user,$dominio){
			$this->user = $user;
			$this->dominio = $dominio;
		}
	}
	class mensaje{
			protected $emailOrigen;
			protected $emailDestino;
			protected $nombre;
			protected $asunto;
			protected $bodyM;
			protected $headerM;
			protected $mensajeM;
			
			function construir($emailOrigen,$emailDestino,$nombre,$asunto,$mensaje=""){
				$this-> emailOrigen = $emailOrigen;
				$this-> emailDestino = $emailDestino;
				$this-> nombre = $nombre;
				$this-> asunto = $asunto;
				$this-> mensajeM=$mensaje;
			}
			
			function header(){
				$headersAviso = "From: ".$this->nombre."<".$this->emailOrigen.">\n"; 
				$headersAviso .= "Reply-To: ".$this->emailOrigen."\n";
				$headersAviso .= "Return-Path: ".$this->emailOrigen."\n"; 
				$headersAviso .= "X-Originally_To: ".$this->emailDestino."\n";
				$headersAviso .= "X-Sender: ".$this->emailOrigen."\n"; 
				$headersAviso .= "X-Mailer: PHP/". phpversion()."\n";
				$headersAviso .= "MIME-Version: 1.0\n";
				$headersAviso .= "Content-Type: text/html; charset=ISO-8859-1\n Content-Transfer-Encoding: 7bit\n\n";
				$headersAviso .= $this->body();
				$headersAviso .= "\n\n";
				$this->headerM = $headersAviso;
			}
			
			function body(){
				$mensaje = "<html>";
				$mensaje .= "<head>";
				$mensaje .= "</head>";
				$mensaje .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' /><title>Documento sin t&iacute;tulo</title><style type='text/css'><!--.Estilo1 {font-size: 36px}.Estilo3 {font-size: 24px;color: #000033;}.Estilo4 {font-size: 18px; color: #000033; }.Estilo5 {font-size: 18px; color: #990000; font-weight: bold; }.Estilo6 {font-size: 18px; color: #000000; font-weight: bold; }.Estilo7 {font-size: 14px; color: #0000CC; font-weight: bold; }--></style></head><body><table width='200' border='7' align='center'><tr><td height='317'><p><img src='http://www.dysloke.com/curso.jpg' width='792' height='201' /></p><p>&nbsp;</p><p align='center'><strong><span class='Estilo1'>Aprend&eacute; Linux de la manera m&aacute;s f&aacute;cil! </span></strong></p><p align='center'>&nbsp;</p><p align='center' class='Estilo4'>El mercado Argentino cada vez necesita mas personas   que sepan utilizar   este sistema operativo, y que puedan dar soluciones   con el, por ello es que tiene una muy buena salida laboral. </p><p align='center' class='Estilo4'>Las personas que el d&iacute;a de ma&ntilde;ana tengan   conocimientos mas variados   de tecnolog&iacute;as por inercia van a ganar mas,   as&iacute; que hay que aprender y   conocer las nuevas tecnolog&iacute;as que se   est&aacute;n empezando a utilizar en las   empresas.</p><p align='center' class='Estilo4'>&nbsp;</p><p align='center' class='Estilo4'>Algunos de los temas que podr&aacute;s aprender:</p><p align='center' class='Estilo5'>Apache2, Webmin, Shell Scripting, Lighttpd, OpenQRM, Samba, NFS, QEMU, Virtualbox, VMware, vnstat, Load Balancing, Iptables, DHCP, SSH, ISPConfig, Gnupanel, HAproxy, Squid, Snort, Rotaci&oacute;n de logs, Proftpd, vsftpd, Bind9, Postfix, Qmail, iRedMail, Axigen, Fail2ban, Honeypots, Nagios, Seguridad WIFI, y much&iacute;simo m&aacute;s ..</p><p align='center' class='Estilo5'>&nbsp;</p><p align='center' class='Estilo5'>Pod&eacute;s ver el temario completo haciendo <a href='http://www.dysloke.com/instel/temario.html'>click ac&aacute;</a> </p><p align='center' class='Estilo5'>&nbsp;</p><p align='center' class='Estilo6'>Tenemos m&aacute;s de 10 a&ntilde;os de experiencia brindando conocimiento a todo el NEA.</p><p align='center' class='Estilo7'>http://www.instelseguridad.com.ar</p><p align='center' class='Estilo7'>Correo: instel@gmail.com</p><p align='center' class='Estilo7'>Mendoza 850 - Corrientes</p><p align='center' class='Estilo7'>Pueyrredon 137 - Resistencia     </p><p align='center' class='Estilo4'>&nbsp;</p><p align='center' class='Estilo4'>&nbsp;</p><p align='center' class='Estilo4'>&nbsp;</p><p align='center' class='Estilo3'>&nbsp;</p><p align='center' class='Estilo3'>&nbsp;</p><p align='center'>&nbsp;</p><p align='center'>&nbsp;</p></td></tr></table></body></html>";
				$mensaje .= "</html>";
				
				//$this->bodyM = $mensaje;
				return $mensaje;
			}
			
			function enviar(){
				if(mail($this->emailDestino, $this->asunto, $this->mensajeM, $this->headerM)) { 
					echo "<h1>Envio exitoso!!!.</h1><br>";
				}else{
					echo "<h1>El envio no pudo ser efectuado.</h1><br>";
				}
			}
	}
	
	class lista{
		protected $manejadorFile;
		protected $fileClear;
		protected $fileDuplicate=array();
		
		function __construct($archivo){
			$this->manejadorFile=file($archivo,FILE_IGNORE_NEW_LINES|FILE_SKIPE_EMPTY_LINES); 
		}
		
		function saveFile(){
			$correoClear = fopen("correoClear.spam","a");
			$x = 0;
			foreach($this->fileClear as $e){
				$x += 1;
				fwrite($correoClear,$e."; ");
			}
			echo "\n$x correos guardados en el archivo correoClear.spam!!";
			fclose($correoClear);
		}
		
	}
	
	class depurar extends lista{
		
		function valida_email($email) {  
			$reg = "#^(((([a-z\d][\.\-\+_] ?)*)[a-z0-9])+)\@(((([a-z\d][\.\-_] ?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$#i";
			return preg_match($reg, $email,$coincide);
		}
		
		function testCantidad($archivo){
			$file_ = fopen($archivo,"r");
			$leer = fread($file_,filesize($archivo));
			$fileDiv = explode(";",$leer);
			echo "Existen ".count($fileDiv)." correos en este archivo";
			fclose($file_);
		}
		
		function basura(){
			$fileEmail=array();
			$fileClear=array();
			$bus = array("/>/","/</","/;/","/:/","/\"/");
			foreach($this->manejadorFile as $line){
				$line2 = preg_replace($bus," ",$line);
				foreach(explode(" ",$line2) as $valor){
					print $valor."\n";
					$fileClear[] = $valor;
				}
			}
			foreach($fileClear as $valor){
				if($this->valida_email($valor)){
					echo "\n[+] {$valor}  => OK!";
					$fileEmail[] = $valor;
				}else{
					echo "\n[-] {$valor} => OUT!";
				}
			}
			$this->fileClear = $fileEmail;//aca deja saca bien todos los correos
			//falta sacar los duplicados y guardar en un txt
		}
		
		function duplicado(){
			foreach($this->fileClear as $valor){
				$correoD = array_pop($this->fileClear);
				$temporal = preg_replace("/".$correoD."/"," ",$this->fileClear);
				$this->fileClear = $temporal;
				$this->fileDuplicate[] = $correoD;
			}
			echo "Duplicados eliminados con exito!!";
			$this->fileClear = $this->fileDuplicate;
		}
	}
?>

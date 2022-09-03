<?php
	function getWeight(){
		//DIO setting
		$x			= 0;
		$portName 	= 'COM1:';
		$baudRate 	= 9600;
		$bits 		= 8;
		$spotBit 	= 1;
		header( 'Content-type: text/plain; charset=utf-8' ); 
		function echoFlush($string){
			echo $string . "\n";
			flush();
			ob_flush();
		}
		if(!extension_loaded('dio')){
			echoFlush( "PHP Direct IO does not appear to be installed for more info see: http://www.php.net/manual/en/book.dio.php" );
			exit;
		}
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$bbSerialPort = dio_open($portName, O_RDWR );
			//we're on windows configure com port from command line
			exec("mode {$portName} baud={$baudRate} data={$bits} stop={$spotBit} parity=n xon=on");
		} 
		else //'nix
		{
			$bbSerialPort = dio_open($portName, O_RDWR | O_NOCTTY | O_NONBLOCK );
			dio_fcntl($bbSerialPort, F_SETFL, O_SYNC);
			//we're on 'nix configure com from php direct io function
			dio_tcsetattr($bbSerialPort, array(
				'baud' => $baudRate,
				'bits' => $bits,
				'stop'  => $spotBit,
				'parity' => 0
			));
		}
		
		if(!$bbSerialPort){
			echoFlush( "Could not open Serial port {$portName} ");
			exit;
		}
		
		$data1 	= dio_read($bbSerialPort, 256);
		$x1 	= substr($data1, -10, 7);
		$x1 	= intval($x1);
		$data2 	= dio_read($bbSerialPort, 256);
		$x2 	= substr($data2, -10, 7);
		$x2 	= intval($x2);
		$data3 	= dio_read($bbSerialPort, 256);
		$x3 	= substr($data3, -10, 7);
		$x3 	= intval($x3);
		$data4 	= dio_read($bbSerialPort, 256);
		$x4 	= substr($data4, -10, 7);
		$x4 	= intval($x4);
		$data5 	= dio_read($bbSerialPort, 256);
		$x5 	= substr($data5, -10, 7);
		$x5 	= intval($x5);
		
		//tutup koneksi DIO
		dio_close($bbSerialPort);
		if(($x1==$x2)&&($x2==$x3)&&($x3==$x4)&&($x4==$x5)){
			$x = $x1;
			if($x<=100){
				return 0;
			}else{
				return $x;
			}
		}
		else{
			return $x;
		}
	}
?>
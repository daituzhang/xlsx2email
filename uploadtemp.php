<?php
	include 'class/simplexlsx.class.php';
	echo "helo";
	if($argv[1]){
		$fileNormal = $argv[1];
		$fileInline = str_replace(".html","-inline.html",$fileNormal);
		$fileText = str_replace(".html","-text.txt",$fileNormal);
	}
	else {
		echo "template file name missing";
		exit;
	}
	/*******************
	xlsx path to be used
	*******************/
	if($argv[2]) {
		$xlsxName = $argv[2];
	}
	else {
		echo "xlsx file name missing";
		exit;
	}

	if($argv[3]) {
		$emailDir = $argv[3];
	}
	else {
		echo "email path missing";
		exit;
	}

	/***********************
	key code in the xlsx doc
	************************/

	$xlsx = new SimpleXLSX($xlsxName);
	

	/**************************************
	read the xlsx doc to get key code column
	***************************************/
	if($argv[4]) {
		$key = $argv[4];
		list($cols,) = $xlsx->dimension();
		$rowIndex = array();
		foreach( $xlsx->rows() as $k => $r) {
			$j++;
			if ($k == 0) {
				for( $i = 0; $i < $cols; $i++) {
					if(isset($r[$i])) {
						$rowIndex[$r[$i]]=$i;
					}
				}
				$keyCodeCol =   $rowIndex[$key];
			} // skip first row
		}
		$xlsx1 = new SimpleXLSX($xlsxName);
		list($cols,) = $xlsx1->dimension();
		$j=0;
	}

	/***************
	read row by row
	**************/
	echo '<h1>Parsing Result</h1>';
	echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
	foreach( $xlsx1->rows() as $k => $r) {
		$j++;
		if ($k == 0) continue; // skip first row
		echo '<tr>';
		echo '<td>'.$j.'</td>';
		for( $i = 0; $i < $cols; $i++) {
			
			echo '<td>'.( (isset($r[$i])) ? $r[$i] : '&nbsp;' ).'</td>';
		}
		echo '</tr>';

	
		/**************************
		generate the emails
		***************************/
		generateEmails($fileNormal, $xlsx, $emailDir, "normal/", $r[$keyCodeCol], $rowIndex, ".html", $r);
		generateEmails($fileInline, $xlsx, $emailDir, "inline/", $r[$keyCodeCol], $rowIndex, ".html", $r);
		generateEmails($fileText, $xlsx, $emailDir, "text/", $r[$keyCodeCol], $rowIndex, ".txt", $r);

	}


	/***************
	insert function
	***************/
	function addclass($filepath, $searchfor,$appendstr){
		$filecontent = file_get_contents($filepath,"c");
		if(strpos($filecontent, $searchfor)) 
		{
			$pos = strpos($filecontent, $searchfor);
	   		$newfile =  substr_replace($filecontent, $appendstr, $pos+strlen($searchfor), 0);
			$file=fopen($filepath,"w");
			fwrite($file,$newfile);
			fclose($file);
		}
	}
	function generateEmails($file, $xlsx, $emailDir, $emailDirSub, $keyCodeColRow, $rowIndex, $fileType, $row ) {
		$template =fopen($file,"r");
		if(!$template) {
		    echo'not exist';
		    exit;
		}
		
		/*********************************
		copy the templates in to emails
		******************************/
		$f= $emailDir.$emailDirSub.$keyCodeColRow .$fileType;
		$nfile=fopen($f,"w");
		while (!feof($template)) {
		    $rose=fgets($template);
	        fwrite($nfile,$rose);
	        
		}
		fclose($nfile);
		fclose($template);
		/**************************************
		replace the key words with the template
		*************************************/
		foreach ($rowIndex as $index) {
			echo "$$$$$$$$$$$$$$$$$$".$index;
			file_put_contents($f,str_replace('{{'.array_search ($index, $rowIndex).'}}',$row[$index],file_get_contents($f)));
		}

	}
?>

<?php



	function loadUsers($filename) {
		$felhasznalok = [];
		$file = fopen($filename, "r");
		
		while(($line = fgets($file)) !== false) {
			$felhasznalok[] = unserialize($line);
		}
		
		fclose($file);
		
		return $felhasznalok;
	}

		
	function saveUser($filename, $user) {
		$file = fopen($filename, "a");
		
		fwrite($file, serialize($user) ."\n");
		
		fclose($file);
	}

	function search($key, $array){
	    foreach ($array as $asd){
	        if(array_key_exists($key, $asd)){
	            return true;
            }
        }
	    return false;
    }

    function search2($array, $user){
        foreach ($array as $asd){
            if($asd["user"] === $user){
                return true;
            }
        }
        return false;
    }


    function delete($key, $filename){
        $file = loadUsers($filename);

        for($i = 0; i < count($file); $i++){
            if(array_key_exists($key, $file[$i])){
                unset($file[$i]);
                break;
            }
        }
        file_put_contents($filename, $file);
    }
	
?>
<?php if(!defined("ACCESS")) die("Direct access not allowed."); 



class Helpers {
	
	public static function cpy($source, $dest, $newroot = '', $level = 0 ){
    if(is_dir($source)) {
        $dir_handle=opendir($source);
				$file=readdir($dir_handle);
        while( $file || ( $file == '0' && $file != '' ) ){
            if($file!="." && $file!=".."){
                if(is_dir($source."/".$file)){
									
									$fileDest = $file; 
									if( $level == 0 && !empty($newroot) ) $fileDest = $newroot; 
									if(!is_dir($dest."/".$fileDest)){
											mkdir($dest."/".$fileDest);
									}
									//file_put_contents( FSROOT . "/logs.txt", ( str_repeat("\t", $level) . $level . " -- " . $source."/".$file . " --- " . $dest."/".$fileDest . "\n" ), FILE_APPEND ); 
									self::cpy($source."/".$file, $dest."/".$fileDest, '', $level+1 );
                } else {
                    copy($source."/".$file, $dest."/".$file);
                }
            }
						$file=readdir($dir_handle);
        }
        closedir($dir_handle);
    } else {
        copy($source, $dest);
    }
	}
	
	
	public static function deleteDirContents($dir) {
		$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
		$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
		foreach($files as $file) {
				if ($file->isDir()){
						rmdir($file->getRealPath());
				} else {
						unlink($file->getRealPath());
				}
		}
	}
	
	
	public static function slugify($text) {
		$text = strtolower($text);
		$patterns = array(
			'/\s+/',
			'/[^\w\-]+/',
			'/\-\-+/',
			'/^-+/',
			'/-+$/'
		);
		$replace = array( '-', '', '-', '', '' );
		
		return preg_replace( $patterns, $replace, $text );
	}
	
	public static function ext($file) {
	 $extension = end(explode(".", $file));
	 return $extension ? $extension : false;
	}
	
	public static function uniqidReal($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
	}
	
	// Get The Initials of Text Phrase
	public static function strInitials($text=""){
		$tx = explode(" ", ucwords(trim($text)));
		$txt = array();
		foreach($tx as $t) 
			if( !empty($t) )
				$txt[] = $t[0];
		return implode("",$txt);
	}
	
	/**
	 * Natural Sort 
	 */
	public static function sortmulti( $array, $index, $order = 'asc', $natsort=FALSE, $case_sensitive=FALSE ) {
		
		$sorted = [];
		if(is_array($array) && count($array)>0) {
			foreach(array_keys($array) as $key) $temp[$key]=$array[$key][$index];
			
			if(!$natsort) {
				if ($order=='asc') asort($temp);
				else arsort($temp);
			}
			else {
				if ($case_sensitive===true) natsort($temp);
				else natcasesort($temp);
				if($order!='asc') $temp=array_reverse($temp,TRUE);
			}
			foreach(array_keys($temp) as $key)
				if (is_numeric($key)) $sorted[]=$array[$key];
				else $sorted[$key]=$array[$key];
			return $sorted;
		}
		
		else $sorted = $array;
		
		return $sorted;
	}
	
	
	/**
	 * Natural Sort 2D
	 */
	public static function naturalsort( $array, $index, $order = 'asc' ) {
		return self::sortmulti($array, $index, $order, true );
	}
	
	
	
	
	
	/**
	 * Lodash Find (for Assoc Arrays only)
	 */
	public static function findIndex( $arr, $find, $matchAll = false ) {
		$index = !$matchAll ? -1 : []; 
		if(empty($arr)) return $index; 
		
		foreach($arr as $i=>$item) {
			foreach( $find as $key=>$value) {
				if( !empty($item[$key]) && $item[$key] == $value ) {
					if( !$matchAll ) $index = $i;
					else $index[] = $i; 
					break;
				}
			}
			
			if(!$matchAll && $index > -1) break;
			
		}
		
		return $index; 
		
	}
	
	// Find and Return Array
	public static function find( $arr, $find, $matchAll = false ) {
		$found = [];
		$index = self::findIndex( $arr, $find, $matchAll );
		
		if(!$matchAll && $index > -1) $found = $arr[$index];
		
		else if( $matchAll && !empty($index) )
			foreach($index as $i) 
				$found[] = $arr[$i];
			
		return $found; 
	}
	
	// Flatten to one array based on a key/field/column
	public static function flatten($arr, $key) {
		$flat = [];
		if(empty($arr)) return $flat;
		
		foreach($arr as $item) 
			if(!empty($item[$key]))
				$flat[] = $item[$key];
			
		return $flat;
	}
	
	
	/** 
	 * in_array for multiple values, all present
	 *
	 * echo in_array_all( [3,2,5], [5,8,3,1,2] ); // true, all 3, 2, 5 present
	 * echo in_array_all( [3,2,5,9], [5,8,3,1,2] ); // false, since 9 is not present
	 */
	public static function in_array_all($needles, $haystack) {
   return empty(array_diff($needles, $haystack));
	}
	
	
	/** 
	 * in_array for multiple values, atleast 1 is present
	 *
	 * echo in_array_any( [3,9], [5,8,3,1,2] ); // true, since 3 is present
	 * echo in_array_any( [4,9], [5,8,3,1,2] ); // false, neither 4 nor 9 is present
	 */
	public static function in_array_any($needles, $haystack) {
   return !empty(array_intersect($needles, $haystack));
	}
	
}
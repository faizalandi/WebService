<?php 
    function Zip($source, $destination) {
        if (extension_loaded('zip') === true) {
            if (file_exists($source) === true) {
                $zip = new ZipArchive();

                if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
                if (is_dir($source) === true)
                {
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

                    foreach ($files as $file)
                    {
                        if (is_file($file) === true)
                        {
                            $zip->addFromString(basename($file), file_get_contents($file));
                        }
                    }
                }

                else if (is_file($source) === true)
                {
                    $zip->addFromString(basename($source), file_get_contents($source));
                }
            }

            return $zip->close();
        }
    }

    return false;
	}
    
	$zipName = $_GET['n'];
	Zip($zipName.'/', 'download/'.$zipName.'.zip');
	header( 'Location: download/'.$zipName.'.zip' ) ;
	
?>
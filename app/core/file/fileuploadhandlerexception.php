<?php
namespace Lilly\Core\File;

class FileUploadHandlerException extends \Exception
{

    private $_errorMessages = array(
            'SizeUnitError' => 'File is too small to measure in Gigabytes.',
            'UploadError' => 'Sorry uploaded file has some errors. Please try re uploading.',
            'TypeError' => 'Sorry file type is not valid.',
            'SizeError' => 'Sorry file is to large to be saved.',
            'DoesNotExists' => 'Sorry file/Directorys does not exists',
            'NotWritable' => 'Sorry file/Directory is not writable'
    );

    public function __construct ($errorMessage)
    {
        echo 'Exception: ' . $this->_errorMessages[$errorMessage] . ' | Error in file: ' .
                 $this->getFile() . ' in line ' . $this->getLine();
    }
}
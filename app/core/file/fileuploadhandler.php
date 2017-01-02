<?php
namespace Lilly\Core\File;

class FileUploadHandler
{

    protected $_fileName;

    protected $_fileSize;

    protected $_fileType;

    protected $_uploadErrors;

    protected $_allowedTypes = array(
            'jpg',
            'jpeg',
            'gif',
            'png',
            'doc',
            'docx',
            'xml',
            'xls',
            'txt',
            'pdf',
            'mp3',
            'ogg',
            'mp4',
            'ppt',
            'pptm',
            'pptx',
            'html',
            'css',
            'js',
            'php'
    );

    protected $_tmpLocation;

    protected $_path;

    public function __construct (Array $file)
    {
        $this->_fileName = $file['name'];
        $this->_fileType = $this->_extension($file['type']);
        $this->_uploadErrors = $file['error'];
        $this->_fileSize = $file['size'];
        $this->_tmpLocation = $file['tmp_name'];
        $this->_purifyName();
    }

    public function __toString ()
    {
        return 'File Name: ' . $this->_fileName . ', Type: ' . $this->_fileType .
                 ', Size: ' . $this->_getFileSizeIn();
    }

    public function getFileName()
    {
        return str_replace(" ", "_", $this->_fileName);
    }

    public function getFileExtension()
    {
        return $this->_fileType;
    }

    public function getFileSize($unit)
    {
        return $this->_getFileSizeIn($unit);
    }

    public function getFilePath()
    {
        return $this->_path;
    }

    public function _fileIsOfValidType ()
    {
        return in_array($this->_fileType, $this->_allowedTypes);
    }

    protected function _fileHasUploadErrors ()
    {
        return ($this->_uploadErrors != 0) ? true : false;
    }

    public function save ($size, $fileName = true, $destination = DOCS_STORAGE_FOLDER)
    {
        if ($this->_fileHasUploadErrors()) {
            throw new FileUploadHandlerException('UploadError');
        } else
            if ($this->_getFileSizeIn() > $size) {
                throw new FileUploadHandlerException('SizeError');
            } else
                if (! $this->_fileIsOfValidType()) {
                    throw new FileUploadHandlerException('TypeError');
                } else {
                    if (! is_dir($destination)) {
                        throw new FileUploadHandlerException('DoesNotExists');
                    } else
                        if (! is_writable($destination)) {
                            throw new FileUploadHandlerException('NotWritable');
                        } else {
                            try {
                                $destination .= (true === $fileName) ? $this->getFileName() : $fileName;
                                move_uploaded_file($this->_tmpLocation, $destination);
                                $this->_path = $destination;
                            } catch (Exception $e) {
                                echo $e->getMessage();
                            }
                        }
                }
    }

    protected function _extension ($fileType)
    {
        $extensionPattern = '/\.[a-z0-9]{1,4}$/i';
        preg_match_all($extensionPattern, $this->_fileName, $matches);
        $extension = $matches[0][0];
        return preg_replace('/\./', '', $extension);
    }

    public function _getFileSizeIn ($sizeunit = 'mb')
    {
        switch ($sizeunit) {
            case 'gb':
                if ($this->_getFileSizeIn() >= 100) {
                    return round(($this->_fileSize / 1024 / 1024 / 1024), 2) .
                             ' GB';
                } else {
                    throw new FileUploadHandlerException('SizeUnitError');
                }
            case 'mb':
                return round(($this->_fileSize / 1024 / 1024), 2);
            case 'kb':
                return round(($this->_fileSize / 1024), 2);
        }
    }

    protected function _purifyName()
    {
        $extensionPattern = '/\.[a-z0-9]{1,4}$/i';
        preg_match_all($extensionPattern, $this->_fileName, $matches);
        $fileExtension = $matches[0][0];

        $this->_fileName = preg_replace($extensionPattern, "", $this->_fileName);

        $spacePattern = '/ /';
        $symbolsPattern = '/\W/';

        $this->_fileName = preg_replace($spacePattern, "", $this->_fileName);
        $this->_fileName = preg_replace($symbolsPattern, "", $this->_fileName);
        $this->_fileName = base64_encode(md5(microtime().$this->_fileName));
        $this->_fileName = strtolower(substr($this->_fileName, 0, 30));
        $this->_fileName = preg_replace('/(\w{7})/', "$1_", $this->_fileName);
        $this->_fileName .= $fileExtension;
    }
}
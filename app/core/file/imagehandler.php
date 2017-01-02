<?php
namespace Lilly\Core\File;

/**
 * @package iWork
 * @author Eng. Mohammed Yehia
 * ImageHandler class is a utility class to manipulate uploaded images
 * and save them to their final destinations
 */
class ImageHandler extends FileUploadHandler
{

    private $_image;

    private $_width;

    private $_height;

    private $_type;

    private $_options;

    public function __construct (Array $file)
    {
        parent::__construct($file);
        $this->_setImageInfo();
    }

    public function getImageWidth ()
    {
        return $this->_width;
    }

    public function getImageHeight ()
    {
        return $this->_height;
    }

    private function _setImageInfo ()
    {
        list ($this->_width, $this->_height, $this->_type) = getimagesize(
                $this->_tmpLocation);
    }

    public function prepare (Array $options, $scale = false)
    {
        $this->_options = $options;
        
        // Collecting Information for the new true color image
        // New Width and Height
        $destinationWidth = (array_key_exists('width', $this->_options)) ? $this->_options['width'] : $this->_width;
        $destinationHeight = (array_key_exists('height', $this->_options)) ? $this->_options['height'] : $this->_height;
        
        // Source / Destination X and Y
        $sourceX = (array_key_exists('srcx', $this->_options)) ? $this->_options['srcx'] : 0;
        $sourceY = (array_key_exists('srcy', $this->_options)) ? $this->_options['srcy'] : 0;
        $destinationX = (array_key_exists('dstx', $this->_options)) ? $this->_options['dstx'] : 0;
        $destinationY = (array_key_exists('dsty', $this->_options)) ? $this->_options['dsty'] : 0;
        
        // Create a new true color blank image
        $blankImage = imagecreatetruecolor($destinationWidth, $destinationHeight);
        
        // FIX: transparented background for PNG and GIF images
        if($this->_type == IMAGETYPE_PNG || $this->_type == IMAGETYPE_GIF)
            $this->_fixTranparency($blankImage);
        
        // Create a base image based on the type of the uploaded image
        $this->_createImage();
        
        // Apply any existing effects to the base image
        if(array_key_exists('watermark', $this->_options))
            $this->_addWaterMark($this->_options['watermark']);
        if(array_key_exists('rotate', $this->_options))
            $this->_rotate($this->_options['rotate']);
        if($scale === true) {
            $this->_image = imagescale($this->_image, $destinationWidth);
            $blankImage = imagecreatetruecolor(imagesx($this->_image), imagesy($this->_image));
            imagecopyresampled($blankImage, $this->_image, $destinationX,
                $destinationY, $sourceX, $sourceY, imagesx($this->_image),
                imagesy($this->_image), imagesx($this->_image), imagesy($this->_image));
        } else {
            // Create the final image
            imagecopyresampled($blankImage, $this->_image, $destinationX,
                $destinationY, $sourceX, $sourceY, $destinationWidth,
                $destinationHeight, $this->_width, $this->_height);
        }

        // Set a handler to the image
        $this->_image = $blankImage;
        return $this;
    }
     
    public function saveIt ()
    {
        if(!isset($this->_options))
            throw new \Exception('You need to create an image first before you save it');
        
        $destination = array_key_exists('destination', $this->_options) ? $this->_options['destination'] : IMAGE_STORAGE_FOLDER;
        $destination .= array_key_exists('fileName', $this->_options) ? $this->_options['fileName'] : $this->_fileName;
        $quality = array_key_exists('quality', $this->_options) ? $this->_options['quality'] : 100;

        switch ($this->_type) {
            case IMAGETYPE_JPEG:
                imagejpeg($this->_image, $destination, $quality);
                break;
            case IMAGETYPE_PNG:
                $quality /= 10;
                $quality = $quality >= 10 ? 9 : $quality;
                imagepng($this->_image, $destination, $quality);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->_image, $destination);
                break;
        }
        
        $this->_path = $destination;
        return $this;
    }
    
    private function _createImage()
    {
        switch ($this->_type) {
            case IMAGETYPE_JPEG:
                $this->_image = imagecreatefromjpeg($this->_tmpLocation);
                break;
            case IMAGETYPE_PNG:
                $this->_image = imagecreatefrompng($this->_tmpLocation);
                $this->_fixTranparency($this->_image);
                break;
            case IMAGETYPE_GIF:
                $this->_image = imagecreatefromgif($this->_tmpLocation);
                $this->_fixTranparency($this->_image);
                break;
        }
    }

    private function _addWaterMark($image)
    {
        $watermark = imagecreatefrompng($image);
        $this->_fixTranparency($watermark);
        list($width, $height) = getimagesize($image);
        imagecopy($this->_image, $watermark, 10, 10, 0, 0, $width, $height);
        imagedestroy($watermark);
    }
    
    private function _fixTranparency($image)
    {
        imagefill($image, 0, 0, IMG_COLOR_TRANSPARENT);
        imagesavealpha($image,true);
        imagealphablending($image, true);
    }
    
    private function _rotate($deg)
    {
        $this->_image = imagerotate($this->_image, $deg, 0, 0);
    }
}
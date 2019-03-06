<?php
namespace App\lib;

use Image;
use File;
use DB;

class ImageHelper{

    public static function getProductImageUploadPath(){
        return '/images/product/';
    }

    public static function checkExtensionImageBase64($imgdata){
        $f = finfo_open();
        $imagetype = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);

        if(empty($imagetype)) return '.jpg';
        switch($imagetype)
        {
            case 'image/bmp': return '.bmp';
            case 'image/cis-cod': return '.cod';
            case 'image/gif': return '.gif';
            case 'image/ief': return '.ief';
            case 'image/jpeg': return '.jpg';
            case 'image/pipeg': return '.jfif';
            case 'image/tiff': return '.tif';
            case 'image/x-cmu-raster': return '.ras';
            case 'image/x-cmx': return '.cmx';
            case 'image/x-icon': return '.ico';
            case 'image/x-portable-anymap': return '.pnm';
            case 'image/x-portable-bitmap': return '.pbm';
            case 'image/x-portable-graymap': return '.pgm';
            case 'image/x-portable-pixmap': return '.ppm';
            case 'image/x-rgb': return '.rgb';
            case 'image/x-xbitmap': return '.xbm';
            case 'image/x-xpixmap': return '.xpm';
            case 'image/x-xwindowdump': return '.xwd';
            case 'image/png': return '.png';
            case 'image/x-jps': return '.jps';
            case 'image/x-freehand': return '.fh';
            default: return false;
        }
    }

    public static function uploadPhoto($foto, $path, $resize=1000, $name=null) {
        $stripped = preg_replace('#^data:image/[^;]+;base64,#', '', $foto);
        // kalo ada foto
        $decoded = base64_decode($stripped);

        // cek extension
        $ext = ImageHelper::checkExtensionImageBase64($decoded);

        // set picture name
        if($name != null)
            $pictName = $name.$ext;
        else
            $pictName = mt_rand(0, 1000).''.time().''.$ext;

        // path
        $upload = $path.$pictName;

        $img    = Image::make($decoded);

        $width  = $img->width();
        $height = $img->height();


        if($width > 1000){
            $img->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $img->resize($resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        if ($img->save($upload)) {
            $result = [
                'status'    => 'success',
                'path'      => $upload,
                'filename'  => $pictName
            ];
        }
        else {
            $result = [
                'status' => 'fail'
            ];
        }

        return $result;
    }

    public static function deletePhoto($path){
        $path = public_path().str_replace(env('APP_URL'),'',$path);

        if (file_exists($path)) {
            if (unlink($path)) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return true;
        }
    }
}
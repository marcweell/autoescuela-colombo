<?php

namespace Flores;

use stdClass;


class Tools
{
    public static $script = "";


    public static function compress_image($source_url, $destination_url, $quality = 100, $w = 500, $h = 500, $crop = false, $overwrite = true)
    {
        if ($overwrite == false) {
            if (file_exists($destination_url) and is_file($destination_url)) {
                return true;
            }
        }

        $info = getimagesize($source_url);

        list($width, $height) = $info;
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        if ($info["mime"] == "image/jpeg") {
            $image = imagecreatefromjpeg($source_url);
        } elseif ($info["mime"] == "image/gif") {
            $image = imagecreatefromgif($source_url);
        } elseif ($info["mime"] == "image/png") {
            $image = imagecreatefrompng($source_url);
        } else {
            $image = imagecreatetruecolor($newwidth, $newheight);
        }

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($dst, $destination_url, $quality);
        return $destination_url;
    }

    public static function write($file, $content)
    {
        if ($fopen = fopen($file, "w")) {
            fwrite($fopen, $content);
        }
        fclose($fopen);
    }

    public static function read($source = "")
    {
        $str = "";
        if (file_exists($source)) {
            $file = fopen($source, "r");
            $str = fread($file, filesize($source));
            fclose($file);
        }

        return $str;
    }

    public static function reArray($arr)
    {
        $ary = [];
        foreach ($arr as $key => $value) {
            array_push($ary, $value);
        }

        return $ary;
    }

    public static function reArrayFiles($file)
    {
        $file_ary = [];
        $file_count = count($file["name"]);
        $file_key = array_keys($file);
        for ($i = 0; $i < $file_count; ++$i) {
            foreach ($file_key as $val) {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }

        return $file_ary;
    }

    public static function count_arr($arr, $k = "")
    {
        $c = 0;
        if ($k == "") {
            $c = count($arr);
        } else {
            $c = count($arr[$k]);
        }

        return $c;
    }

    public static function sum_arr($arr, $k = "")
    {
        $c = 0;
        if ($k == "") {
            for ($i = 0; $i < @count($arr); ++$i) {
                $c += $arr[$i];
            }
        } else {
            for ($i = 0; $i < @count($arr[$k]); ++$i) {
                $c += $arr[$k][$i];
            }
        }

        return $c;
    }

    public static function count_occ_arr($arr, $find)
    {
        $c = 0;
        if (is_array($arr)) {
            foreach ($arr as $i => $value) {
                if ($value != @$find) {
                    continue;
                }
                ++$c;
            }
        }

        return $c;
    }

    public static function count_arr_except($arr, $find)
    {
        $c = 0;
        foreach ($arr as $i => $value) {
            if ($value == @$find) {
                continue;
            }
            ++$c;
        }

        return $c;
    }

    public static function date_convert($str, $format = "d-m-Y, H:i")
    {
        if (@($str = strtotime($str)) !== false) {
            $str = date($format, $str);
        }

        return $str;
    }

    public static function date_compare($date1 = "", $date2 = "", $d1format = "d/m/Y H:i")
    {
        if (($date1 = strtotime($date1)) !== false and ($date2 = strtotime($date1)) !== false) {
            $date1 = date($d1format, $date1);
            $date2 = date($d1format, $date2);
            if ($date1 == $date2) {
                return true;
            }
        }

        return false;
    }

    public static function is_date($str, $format)
    {
        if (($str = strtotime($str)) !== false) {
            return true;
        }

        return false;
    }

    public static function give_space($str, $s = 3, $char = " ")
    {
        $arr = [];
        $c = 0;
        while (strlen($str) > $s) {
            $arr[$c] = substr($str, 0, $s) . $char;
            $str = substr($str, $s);
            ++$c;
        }
        set_time_limit($c * 2);
        $arr[$c] = $str;
        ++$c;
        $str = "";
        for ($i = 0; $i < @count($arr); ++$i) {
            $str .= $arr[$i];
        }

        return $str;
    }

    public static function num($num = 0, $dec = 2,$decimal=".",$thousands = ",")
    {
        if (!is_numeric($num)) {
            return number_format(0, $dec,$decimal,$thousands);
        }

        return number_format($num, $dec,$decimal,$thousands);
    }


    public static function getInt($num = 0)
    {
        if (!is_numeric($num)) {
            return intval(0);
        }

        return intval($num);
    }

    //-------------------------
    // security
    //-------------------------

    public static function hash($str)
    {
        $str = sha1($str);
        $str = base64_encode($str);
        $str = md5($str);

        return $str;
    }

    public static function encode($str, $loops = 5)
    {
        for ($i = 0; $i < $loops; ++$i) {
            $str = base64_encode($str);
            $str = str_replace("=", "", $str);
            $str = Tools::give_space($str, 30, ".");
            $arr = [];
            $arr = explode(".", $str);
            if (count($arr) > 0) {
                $str = "";
                for ($index = count($arr) - 1; $index >= 0; --$index) {
                    $str .= $arr[$index];
                    if ($index > 0) {
                        $str .= ".";
                    }
                }
            }
            if ($i == $loops - 1) {
                $str = base64_encode($str);
            }
            $str = str_replace("=", "", $str);
        }

        return $str;
    }

    public static function decode($str, $loops = 5)
    {

        for ($i = 0; $i < $loops; ++$i) {
            if ($i == 0) {
                $str = base64_decode($str);
            }
            $arr = [];
            $arr = explode(".", $str);
            if (count($arr) > 0) {
                $str = "";
                for ($index = count($arr) - 1; $index >= 0; --$index) {
                    $str .= $arr[$index];
                    if ($index > 0) {
                        $str .= ".";
                    }
                }
            }
            $str = base64_decode($str);
        }

        return $str;
    }



    /**
     *
     *
     */

    //-------------------------
    // upload
    //-------------------------
    public static function upload($file, $name, $path = "")
    {
        $temp_file = $path . $name;
        if (move_uploaded_file($file["tmp_name"], $temp_file)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public static function upload_base64($content, $name, $folder)
    {
        $data_types = ["png", "jpg", "jpeg", "zip", "rar", "mp3", "mp4", "docx", "doc", "pdf", "7z", "xls", "xlsx"];

        $b64 =  explode(",", $content);

        $extension = "";

        $decoded = base64_decode($b64[array_key_last($b64)]);

        foreach ($data_types as $key => $value) {
            if (str_contains($b64[array_key_first($b64)], $value)) {
                $extension = "." . $value;
                break;
            }
        }

        while (str_ends_with($folder, "/") == true) {
            $folder = substr($folder, 0, strlen($folder) - 1);
        }

        $filename = implode([
            trim($folder),
            "/",
            trim($name, "/"),
            trim($extension, "/"),
        ]);


        $file = fopen($filename, 'wb');
        fwrite($file, $decoded);
        fclose($file);

        return $name . $extension;
    }

    public static function fileTobase64($file, $alt = "public/assets/img/user_.png")
    {
        if (!is_file(base_path($file))) {
            $info = pathinfo(base_path($alt));
        } else {

            $info = pathinfo(base_path($file));
        }
        return "data:image/" . $info["extension"] . ";base64, " . base64_encode(file_get_contents($info["dirname"] . "/" . $info["filename"] . "." . $info["extension"]));
    }

    public static function photo($file, $path = "storage/profile-pic")
    {
        $file_name = implode(
            [
                trim($path, "/\t\n"),
                "/",
                trim($file, "/\t\n")
            ]
        );
        if (!is_file(base_path($file_name))) {
            $file_name = ("public/assets/img/user.png");
        }

        return url($file_name);
    }
    public static function file($file, $path = "storage/files")
    {
        $file_name = implode(
            [
                trim($path, "/\t\n"),
                "/",
                trim($file, "/\t\n")
            ]
        );
        if (!is_file(base_path($file_name))) {
            $file_name = "public/essential/img/logo.png";
        }

        return url($file_name);
    }
    public static function getJsonObj($file){
        $json = self::read($file);
        return json_decode($json);

    }
}

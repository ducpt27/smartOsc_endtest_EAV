<?php

namespace Mvc\Controllers;

abstract class BaseController
{
    public $folder;

    protected function render($view, $data = [])
    {
        $root = 'app/';

        $layouts_file = [
            'header' => $root . 'Views' . DIRECTORY_SEPARATOR . $this->folder . 'layouts' . DIRECTORY_SEPARATOR . 'header.php',
            'footer' => $root . 'Views' . DIRECTORY_SEPARATOR . $this->folder . 'layouts' . DIRECTORY_SEPARATOR . 'footer.php',
            'content' => $root . 'Views' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php'
        ];

        extract($data);
        foreach ($layouts_file as $key => $value) {
            if (is_file($value)) {
                ob_start();
                require_once($value);
                $layouts[$key] = ob_get_clean();
            } elseif ($key == 'content') {
                echo 'can\'t find view file: ' . $value;
            }
        }
        require_once $root . 'Views' . DIRECTORY_SEPARATOR . $this->folder . 'layouts' . DIRECTORY_SEPARATOR . 'master.php';
    }

    /*
     * Upload file image
     * @param file $file
     * @param int $index
     * @return string
     */
    public function uploadFileImage($file = null, $index = 0)
    {
        if (is_null($file)) {
            return;
        }

        static $directory_files;
        if ($index == 0) {
            $directory_files = [];
        }
        
        $errors = array();
        $file_name = $file['name'][$index];
        $file_size = $file['size'][$index];
        $file_tmp = $file['tmp_name'][$index];
        $file_type = $file['type'][$index];
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false){
            $errors[] = "Extension not allowed, please choose a JPEG, JPG, PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            while (true) {
                $file_name_new = uniqid($tmp[0], true);
                $directory_file_asset = $this->asset("upload/image/" . $file_name_new) . '.' . $file_ext;
                $directory_file = "upload/image/" . $file_name_new . '.' . $file_ext;
                if (!file_exists(sys_get_temp_dir() . $directory_file_asset)) break;
            }
            move_uploaded_file($file_tmp, $directory_file_asset);
            $directory_files[] = $directory_file;
        } else {
            print_r($errors);
        }

        $index++;
        if (isset($file['name'][$index])) {
            $tmp = $this->uploadFileImage($file, $index);
        }
        return $directory_files;
    }

    /*
     * Get the file path from the root directory
     * @param string $file
     * @return string
     */
    public function asset($file)
    {
        $root = 'app/';
        return $root . 'Public' . DIRECTORY_SEPARATOR . $file;
    }

    protected function testInput($data)
    {

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->testInput($value);
            }
            return $data;
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
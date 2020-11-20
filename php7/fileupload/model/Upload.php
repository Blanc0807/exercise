<?php

namespace Model;

include_once '../../helper/function.php';

class Upload
{

    private string $dir;

    public function make(): array
    {
        $this->mkDir();
        $files = $this->format();
        // 保存上传件信息
        $uploadFiles = [];

        foreach ($files as $file) {
            if ($file['error'] === 0) {
                // 上传成功
                if (is_uploaded_file($file['tmp_name'])) {
                    $to = $this->dir . time() . rand(1, 999) . '.' . pathinfo($file['name'])['extension'];
                    if (move_uploaded_file($file['tmp_name'], $to)) {
                        $uploadFiles['success'][] = [
                            'name' => $file['name'],
                            'size' => size_info($file['size']),
                            'path' => $to,
                        ];
                    }
                }
            } else {
                // 上传失败
                $uploadFiles['fail'][] = [
                    'name' => $file['name'],
                    'error_code' => $file['error'],
                ];
            }
        }
        return $uploadFiles;
    }

    private function mkDir(): bool
    {
        $path = '../source/uploads/' . date('Y/m/d') . '/';
        $this->dir = $path;
        return is_dir($path) or mkdir($path, 0755, true);
    }

    private function format()
    {
        $files = [];
        foreach ($_FILES as $filed) {
            if (is_array($filed['name'])) {
                foreach ($filed['name'] as $id => $file) {
                    $files[] = [
                        'name' => $filed['name'][$id],
                        'type' => $filed['type'][$id],
                        'tmp_name' => $filed['tmp_name'][$id],
                        'error' => $filed['error'][$id],
                        'size' => $filed['size'][$id],
                    ];
                }
            } else {
                $files[] = $filed;
            }
        }
        return $files;
    }

}
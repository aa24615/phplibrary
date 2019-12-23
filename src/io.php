<?php


//生成目录树
function mkdirs($dir)
{
    $arr = explode('/', $dir);
    $p = $dir{0}=='/' ? '/' : '';
    foreach ($arr as $v) {
        $v = trim($v);
        if ($v) {
            $p .= $v . "/";
            if (!file_exists($p)) {
                mkdir($p, 0777, true);
            }
        }
    }
    return true;
}

/**
 * 删除文件夹
 * @param string $dirname 目录
 * @param bool $withself 是否删除自身
 * @return boolean
 */
function rmdirs($dirname, $withself = true)
{
    if (!is_dir($dirname))
        return false;
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dirname, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        @$todo($fileinfo->getRealPath());
    }
    if ($withself) {
        @rmdir($dirname);
    }
    return true;
}


/**
 * 复制文件夹
 * @param string $source 源文件夹
 * @param string $dest 目标文件夹
 */
function copydirs($source, $dest)
{
    if (!is_dir($dest)) {
        mkdir($dest, 0755, true);
    }
    foreach (
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $item
    ) {
        if ($item->isDir()) {
            $sontDir = $dest . '/' . $iterator->getSubPathName();
            if (!is_dir($sontDir)) {
                mkdir($sontDir, 0755, true);
            }
        } else {
            copy($item, $dest . '/' . $iterator->getSubPathName());
        }
    }
}


/**
 * 遍历文件
 * @param string $dir 路径
 * @param string|array $suffixs 指定后缀名
 * @return array
 */
function get_dirs($dir = "", $suffixs = [])
{
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $list = [];
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $filename = $dir . '/' . $file;
                    $is = false;
                    if (is_dir($filename)) {
                        $list = array_merge($list, get_dirs($filename, $suffixs));
                    } else {

                        $info = pathinfo($file);
                        $ext = $info['extension'];
                        $name = $info['filename'];
                        if ($suffixs) {
                            if (is_array($suffixs)) {
                                if (in_array($ext, $suffixs)) {
                                    $is = true;
                                }
                            } else {
                                if ($ext == $suffixs) {
                                    $is = true;
                                }
                            }
                        } else {
                            $is = true;
                        }
                    }
                    if ($is) {
                        $size = filesize($filename);
                        $list[] = [
                            'filename' => $filename,
                            'name' => $name,
                            'ext' => $ext,
                            'dir' => $dir,
                            'size' => $size
                        ];
                    }
                }
            }
            closedir($dh);
            return $list;
        } else {
            return "目录不存在: {$dir}";
        }
    } else {
        return "目录不存在: {$dir}";
    }
}

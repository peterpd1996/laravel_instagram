<?php

namespace App\Services;
use App\Services\TestService;

class FileLogService
{
    /**
     * create log file
     *
     * @param string $fileName
     * @param string $content
     *
     */
    protected $print;
    public function __construct(TestService $test)
    {
        $this->test = $test;
    }

    public function print()
    {
       return $this->test->test();
    }

    public function createLog(string $fileName,string $content)
    {
        $this->checkFolderPathExist();
        $filePath = $this->getFilePath($fileName);
        try {
            file_put_contents($filePath,$content,FILE_APPEND);
        } catch (\Exception $e) {
            $content = 'Error: '. $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile() ."\n";
            file_put_contents($filePath,$content,FILE_APPEND);
        }
    }

    /**
     * Get path of file log
     *
     * @param string $fileName
     * @return string
     */
    private function getFilePath(string $fileName)
    {
        return storage_path() . '/logs/log-delete/' . $fileName . '.log';
    }

    /**
     * Get folder path
     * @return string
     */
    private function getFolderPath()
    {
        return storage_path() . '/logs/log-delete/';
    }

    /**
     * Check if the folder log file exist or not
     * If not, then create new folder
     */
    private function checkFolderPathExist()
    {
        $folderPath = $this->getFolderPath();
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EditorController extends BaseController
{
    public function upload()
    {
        return view('/editor/upload');
    }

    public function upload_process_json()
    {

        // SmartEditor2 업로드 input name = "files[]"
        $file = $this->request->getFile('files.0');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                "result" => false,
                "msg" => "업로드된 파일이 없습니다."
            ]);
        }

        // 파일 저장
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/temp', $newName);

        // 이미지 URL (브라우저 접근용)
        $fileUrl = base_url('uploads/temp/' . $newName);

        // SmartEditor2 photo_uploader가 요구하는 JSON 형태
        return $this->response->setJSON([
            "result" => true,
            "files" => [
                [
                    "url"  => $fileUrl,
                    "name" => $newName
                ]
            ]
        ]);
    }
}

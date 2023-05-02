<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\FormModel;
class FormController extends Controller


{
    public function index()
    {
        return view('posts/index');
    }
    public function importCsvToDb()
    {

        $input = $this->validate([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
        ]);
        if (!$input) {
            $data['validation'] = $this->validator;
            return view('index', $data);
        }else{
            if($file = $this->request->getFile('file')) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/".$newName,"r");
                    $i = 0;
                    $numberOfFields = 4;
                    $csvArr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        if($i > 0 && $num == $numberOfFields){
                            $csvArr[$i]['title'] = $filedata[0];
                            $csvArr[$i]['description'] = $filedata[1];
                            $csvArr[$i]['created_at'] = $filedata[2];
                            $csvArr[$i]['updated_at'] = $filedata[3];
                        }
                        $i++;
                    }
                    fclose($file);
                    $count = 0;
                    foreach($csvArr as $userdata){
                        $records = new FormModel();
                        $findRecord = $records->where('title', $userdata['title'])->countAllResults();
                        if($findRecord == 0){
                            if($records->insert($userdata)){
                                $count++;
                            }

                        }
                    }
                    session()->setFlashdata('message', $count.' rows successfully added.');
                    session()->setFlashdata('alert-class', 'alert-success');
                }else{
                    session()->setFlashdata('message', 'CSV file could not be imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            }else{
                session()->setFlashdata('message', 'CSV file could not be imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        return redirect()->route('posts');
    }
}
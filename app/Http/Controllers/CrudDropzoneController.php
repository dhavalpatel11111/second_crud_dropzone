<?php

namespace App\Http\Controllers;

use App\Models\crudDropzone;
use App\Models\imgtable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CrudDropzoneController extends Controller
{
    public function addimg(Request $request)
    {

        $id = $request->all()['ei'];

        if (empty($id)) {
            $allimgname = [];
            $tmpFolder = time() . "_tmpFolder";

            $path = public_path('imgsFolder/' . $tmpFolder);

            for ($i = 0; $i < count($request->file('file')); $i++) {
                $imgname = $request->file('file')[$i]->getClientOriginalName();

                $request->file('file')[$i]->move($path, $imgname);
                array_push($allimgname, $imgname);
            }

            $dataArr = [$allimgname, $tmpFolder];
            return $dataArr;
        } else {
            $allimgname = [];


            $path = public_path('imgsFolder/' . $id);


            for ($i = 0; $i < count($request->file('file')); $i++) {
                $imgname = $request->file('file')[$i]->getClientOriginalName();

                $request->file('file')[$i]->move($path, $imgname);
                array_push($allimgname, $imgname);
            }

            return $allimgname;
        }
    }


    public function imgdel(Request $request)
    {
        $imgdata =  $request->all()['imgdata'];
        $imgname = explode("/", $imgdata);

        $path = public_path("imgsFolder/" . $imgdata);

        if (File::exists($path)) {
            echo "done";
            unlink($path);
            imgtable::where('img', $imgname[1])->delete();
        } else {
            echo "not done";
        }
    }








    public function add(Request $request)
    {
        $all = $request->all();
        echo '<pre>';
        print_r($all);
        die;

        if ($all['hid'] < 1) {

            $allimg = explode(",", $all['allimg']);
            $responce['status'] = 0;
            if (crudDropzone::create([
                'fname' => $all['fname'],
                'lname' => $all['lname'],
                'no' => $all['no'],
                'status' => $all['status'],
            ])) {
                $responce['status'] = 1;
                $responce['message'] = "Data Inserted Succesfully ";

                $id = DB::getPdo()->lastInsertId();

                $path = public_path("imgsFolder/") . $all['folder'];
                $newpath = public_path("imgsFolder/") . $id;

                if (file_exists($path)) {

                    if (rename($path, $newpath)) {
                    } else {
                    }
                } else {
                }

                if ($id == " ") {
                } else {
                    for ($i = 0; $i < count($allimg); $i++) {
                        imgtable::create([
                            'mainid' => $id,
                            'img' => $allimg[$i]
                        ]);
                    }
                }
            } else {
                $responce['status'] = 0;
                $responce['message'] = "Finding Some Error ";
            }
            return $responce;
        } else {

            print_r($all['hid']);
            $post = crudDropzone::find($all['hid']);

            $path = public_path("imgsFolder/") . $all['hid'];

            if (file_exists($path)) {
            } else {
            }

            $imgpost = imgtable::where('mainid', $all['hid'])->delete();

            $allimg = explode(",", $all['allimg']);

            $post->update([
                'fname' => $all['fname'],
                'lname' => $all['lname'],
                'no' => $all['no'],
                'status' => $all['status'],
            ]);

            for ($i = 0; $i < count($allimg); $i++) {
                imgtable::create([
                    'mainid' => $all['hid'],
                    'img' => $allimg[$i]
                ]);
            }
        }

        return "Done";
    }

    public function list()
    {

        $alldata = crudDropzone::where('status', 'Active')->get();
        $no = 0;
        $data = [];
        foreach ($alldata as $value) {
            $temp['id'] = ++$no;
            $temp['fname'] = $value->fname;
            $temp['lname'] = $value->lname;
            $temp['no'] = $value->no;
            $temp['status'] = $value->status;
            $temp['action'] = "<button class='delete btn btn-outline-danger' id='del' data-id='" . $value['id'] . "'>Delete</button>
            <button class='edit btn btn-outline-success' id='edit' data-id='" . $value['id'] . "'>Edit</i></button>";
            array_push($data, $temp);
        }
        return response()->json(['data' => $data]);
    }

    public function del(Request $request)
    {
        $post = $request->all();

        $data = cruddropzone::find($post['id']);
        imgtable::where('mainid', $post['id'])->delete();

        $path = public_path("imgsFolder/") . $post['id'];


        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        $data->delete();

        $responce['status'] = 0;
        if ($data) {
            $responce['status'] = 1;
            if ($responce['status'] = 1) {
                $responce['mesege'] = "Data Deleted ";
            } else {
                $responce['mesege'] = "Data not Deleted";
            }
        } else {
        }
        return $responce;
    }

    public function edit(Request $request)
    {
        $post =   $request->post();



        $responce['status'] = 0;
        if ($post['id'] > 0) {
            $data = cruddropzone::find($post['id']);

            $imgdata =  imgtable::where('mainid', $post['id'])->get();
            $imgname = [];
            $html = '';

            for ($i = 0; $i < count($imgdata); $i++) {
                array_push($imgname, $imgdata[$i]->img);
                $html .= "<div class='imglist'><img src='" . asset("imgsFolder/" . $post['id'] . "/" . $imgdata[$i]->img) . "' alt='your img' height='150px' width='auto' class='editimg'> <button type='button' class='btn btn-danger imgdel' id='imgdel' data-id='" .  $post['id'] . "/" . $imgdata[$i]->img . "'>Delete</button></div>";
            }

            if (!empty($data)) {
                $responce['data'] = [$data];
                $responce['imgdata'] = [$imgdata];
                $responce['img'] = [$html];
            } else {
                $responce['messege'] = "data not found";
                $responce['status'] = 1;
            }
        } else {
            $responce['messege'] = "somthing gone wrong";
        }
        return $responce;
    }
}

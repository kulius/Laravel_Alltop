<?php

namespace Modules\Example\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use Image;
use Validator;

class E00300Controller extends Controller
{

    public function addProcess()
    {
        $inputData = request()->all();
        $rules     = [
            'main_img' => ['file', 'image', 'max:10240'],
        ];
        $validator = Validator::make($inputData, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $photo              = $inputData['main_img'];
        $file_name          = uniqid() . '.' . $photo->getClientOriginalExtension();
        $file_relative_path = 'assess/images/content/' . date('Y-m-d');
        $file_path          = public_path($file_relative_path);
        if (!is_dir($file_path)) {
            mkdir($file_path);
        }
        $thumbnail_file_path = $file_path . '/thumbnail-' . $file_name;
        $image               = Image::make($photo)->resize(200, null, function ($constraint) {$constraint->aspectRatio();})->save($thumbnail_file_path);
        $file_path .= '/' . $file_name;
        $image = Image::make($photo)->save($file_path);

        echo "上傳成功!";

    }

    public function index()
    {
        return view('example::E00300.index', array(
        ));
    }
}

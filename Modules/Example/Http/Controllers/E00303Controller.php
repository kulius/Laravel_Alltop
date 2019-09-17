<?php

namespace Modules\Example\Http\Controllers;

use App;
use App\Alltop\Common;
use App\Database\ACAD\tELCTeacher\Model\tELCTeacher;
use App\Database\UPLOAD\tITFILE\Model\tITFILE;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class E00303Controller extends Controller
{
    //語言中心教師維護主畫面
    public function index(Request $request)
    {
        App::setLocale('en');
        $sPersonalID = $request->get('PersonalID_srh');

        $aWhere = array();
        if ($sPersonalID) {
            $aWhere[] = array('PersonalID', '=', $sPersonalID);
        }
        $data = tELCTeacher::where($aWhere)->get();

        return view('example::E00303.index', array(
            'data' => $data,
        ));
    }

    //語言中心教師新增編輯畫面
    public function view(Request $request, $status = null, $id = null)
    {
        //若為檢視則無法編輯
        if ($status == 'view') {
            session()->flash('status', 'view');
        }

        //老師資料
        $data = tELCTeacher::find($id);

        //讀照片路徑
        $sPath      = 'C:/UPLOAD/E01/' . $data['Emp_ID'];
        $aPhotoFile = tITFILE::where('file_path', $sPath)
            ->orderBy('ins_datetime', 'desc')->first();
        $sPhotoPath = $sPath . '/' . $aPhotoFile['file_name'];

        return view('example::E00303.view', array(
            'data'       => $data,
            'status'     => $status,
            'sPhotoPath' => $sPhotoPath,
            'aPhotoFile' => $aPhotoFile,
        ));
    }

    //新增編輯畫面POST
    public function save(Request $request, $status = null, $id = null)
    {
        $event = $request->get('event');
        $data  = Common::getInput($request->all());

        $request->flash();

        if ($event === 'save') {
            //ID驗證用
            $Emp_ID = isset($id) ? $id : null;
            // 驗證分別傳入data、驗證規則、錯誤訊息
            $validator = $this->validateRules($data, $Emp_ID);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            //照片上傳 ************
            if (isset($data['Photo'])) {
                $file = $data['Photo'];

                //原始檔名
                $picName = $file->getClientOriginalName();
                //儲存的檔名
                $fileName = $data['Emp_ID'] . '.' . $file->getClientOriginalExtension();
                //檔案類型
                $picType = $file->getClientMimeType();
                //檔案大小
                $picSize = $file->getClientSize();

                // dd($picName);
                // $messages = array(
                //     'Photo.*.mimes' => '照片副檔名不正確',
                // );

                // $photoValidator = Validator::make($request->all(), array(
                //     'Photo.*' => 'mimes:jpeg,jpg,png,gif',
                // ), $messages);

                //照片驗證格式
                $rules = [
                    'Photo' => ['file', 'image', 'max:10240'],
                ];
                $messages = [
                    'Photo.image' => '上傳檔案類型不是圖片',
                    'Photo.max'   => '檔案大小超過 10 MB',
                ];
                $photoValidator = Validator::make($data, $rules, $messages);

                if ($photoValidator->fails()) {
                    return redirect()->back()->withInput()->withErrors($photoValidator);
                };

                $directoryName = 'C:/UPLOAD/E01/' . $data['Emp_ID'];

                //建立資料夾
                if (!is_dir($directoryName)) {
                    mkdir($directoryName, 0755, true);
                }
                //照片儲存路徑C:\UPLOAD\E01\{ID}\
                $imagePath = str_replace('/', "\\\\", $directoryName);

                // dd($picName, $picType, $picSize, $directoryName, $file);
                $files = tITFILE::create(
                    ['formid'     => 'E01',
                        'file_name'   => $picName,
                        'file_type'   => $picType,
                        'file_size'   => $picSize,
                        'file_encode' => '',
                        'file_path'   => $directoryName,
                        'ins_userid'  => Session::get('user_id'),
                    ]
                );

                //TODO::照片上傳路徑
                //儲存檔案
                // $file->move($imagePath, $picName);
                $file->move(public_path('/Image'), $fileName);
            }
            //更新或新增資料
            $result = tELCTeacher::updateOrCreate(array('Emp_ID' => $id), $data);

            if ($result) {
                Session::flash('sweet', array('success', '儲存執行成功！'));
            } else {
                Session::flash('sweet', array('error', '儲存執行失敗！'));
            }
            return redirect()->route('e01130_view', array('edit', $result->Emp_ID));

        } else {
            return view('e01::E00303.view', array(
                'data'   => $data,
                'status' => $status,
            ));
        }
    }

    public function validateRules($aData, $ID)
    {
        //驗證規則
        $rules = array(
            'Emp_ID' => 'required|max:20|unique:ACAD.tELCTeacher,Emp_ID,' . $ID . ',Emp_ID',
        );

        //驗證錯誤訊息
        $messages = array(
            'Emp_ID.required' => '請輸入教師編號',
            'Emp_ID.max'      => '教師編號不可超過20字',
            'Emp_ID.unique'   => '教師編號 ' . $aData['Emp_ID'] . ' 已經存在',
        );

        //驗證資料正確性
        return Validator::make($aData, $rules, $messages);
    }

}

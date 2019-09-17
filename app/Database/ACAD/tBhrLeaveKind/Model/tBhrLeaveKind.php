<?php
namespace App\Database\ACAD\tBhrLeaveKind\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrLeaveKind extends Model
{
    protected $connection = 'ACAD';

    public $table = 'tBhrLeaveKind';

    public $timestamps = false;

    public $primaryKey = 'LeaveKindID';
    // public $incrementing = false;
    // public $casts        = array(
    //     'LeaveKindID' => 'string',
    // );

    public $fillable = array(
        'Seq',
        'LeaveKindName',
        'LeaveKindEName',
        'LeaveKindAlias',
        'Leavedeadline',
        'IsUpload',
        'LeaveCount',
        'state',
        // 'IsAbsenteeism',
        'Memo',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $rules = array(
        'Seq'            => 'required|integer',
        'LeaveKindName'  => 'required|max:50',
        'LeaveKindEName' => 'max:50',
        'LeaveKindAlias' => 'max:50',
        'Leavedeadline'  => 'required|integer',
        'IsUpload'       => 'required',
        'LeaveCount'     => 'required|integer',
        'state'          => 'required',
        // 'IsAbsenteeism'  => 'required',
        'Memo'           => 'max:200',
    );

    public $messages = array(
        'Seq.required'           => '請輸入順序',
        'Seq.integer'            => '順序需為整數格式',
        'LeaveKindName.required' => '請輸入假別名稱',
        'LeaveKindName.unique'   => '假別名稱不可重複',
        'LeaveKindName.max'      => '假別名稱不可超過50字',
        'LeaveKindEName.max'     => '假別英文不可超過50字',
        'LeaveKindAlias.max'     => '假別簡稱不可超過50字',
        'Leavedeadline.required' => '請輸入請假期限',
        'Leavedeadline.integer'  => '請假期限需為整數格式',
        'IsUpload.required'      => '請輸入是否需上傳附件',
        'LeaveCount.required'    => '請輸入限制請假次數',
        'LeaveCount.integer'     => '限制請假次數需為整數格式',
        'state.required'         => '請選擇停復用狀態',
        'IsAbsenteeism.required' => '請選擇是否列入缺勤',
        'Memo.max'               => '備註內容不可超過200字',
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->StdGroupAbsentMemberID) {
            // only set a UUID on first creation and if not already set
            // $model->StdGroupAbsentMemberID = (string) Str::uuid();
            // }

            $model->ApplyID   = Session::get('user_id');
            $model->ApplyDate = Carbon::now();
        });

        static::updating(function ($model) {
            $model->UpdateID   = Session::get('user_id');
            $model->UpdateDate = Carbon::now();
        });
    }
}

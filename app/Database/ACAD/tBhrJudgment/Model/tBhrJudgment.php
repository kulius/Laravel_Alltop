<?php
namespace App\Database\ACAD\tBhrJudgment\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrJudgment extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrJudgment';

    public $timestamps = false;

    public $primaryKey = 'JudgmentID';

    // public $incrementing = false;

    // public $casts = array(
    //     'JudgmentID' => 'string',
    // );

    public $fillable = array(
        "JudgmentKindID",
        "JudgmentContent",
        "state",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );
    public $rules = array(
        'JudgmentContent' => 'required|max:50',
        'state'           => 'required',
    );

    public $messages = array(
        'JudgmentContent.required' => '請輸入操行評語名稱',
        'JudgmentContent.max'      => '操行評語名稱不可超過50字',
        'JudgmentContent.unique'   => '操行評語名稱不可重複',
        'state.required'           => '請選擇狀態',
    );

}

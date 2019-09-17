<?php
namespace App\Database\ACAD\tBhrJudgmentKind\Model;

use Illuminate\Database\Eloquent\Model;

class tBhrJudgmentKind extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrJudgmentKind';

    public $timestamps = false;

    public $primaryKey = 'JudgmentKindID';

    // public $incrementing = false;

    // public $casts        = array(
    //     'JudgmentKindID' => 'string',
    // );

    public $fillable = array(
        "JudgmentKindName",
        "state",
        "ApplyID",
        "ApplyDate",
        "UpdateID",
        "UpdateDate",
    );
    public $rules = array(
        'JudgmentKindName' => 'required|max:50',
        'state'            => 'required',
    );

    public $messages = array(
        'JudgmentKindName.required' => '請輸入評語類別名稱',
        'JudgmentKindName.max'      => '評語類別名稱不可超過50字',
        'JudgmentKindName.unique'   => '評語類別名稱不可重複',
        'state.required'            => '請選擇狀態',
    );

}

<?php
namespace App\Database\ACAD\tBhrSettleDateBatch\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class tBhrSettleDateBatch extends Model
{
    //
    protected $connection = 'ACAD';

    public $table = 'tBhrSettleDateBatch';

    public $timestamps = false;

    public $primaryKey = 'SettleDateBatchID';

    // public $incrementing = false;

    public $fillable = array(
        'ACADYear',
        'Semester',
        'DayfgID',
        'BhrScoreDate',
        'BhrScoreDateGrade',
        'AbsentSDate',
        'AbsentEDate',
        'AbsentSDateGrade',
        'AbsentEDateGrade',
        'RPDataSDate',
        'RPDataEDate',
        'RPDataSDateGrade',
        'RPDataEDateGrade',
        'TutorAddSubDate',
        'CadreRewardDate',
        'EliminateDate',
        'RollCallDate',
        'ApplyID',
        'ApplyDate',
        'UpdateID',
        'UpdateDate',
    );

    public $casts = array(
        // 'SettleDateBatchID' => 'string',
        'AbsentSDate'      => 'datetime',
        'AbsentEDate'      => 'datetime',
        'AbsentSDateGrade' => 'datetime',
        'AbsentEDateGrade' => 'datetime',
    );

    public $rules = array(
        'ACADYear' => 'required|max:3',
        'Semester' => 'required|max:2',
        'DayfgID'  => 'required',
    );

    public $messages = array(
        'ACADYear.required' => '請選擇學年',
        'ACADYear.max'      => '學年長度不可超過3字',
        'Semester.required' => '請選擇學期',
        'Semester.max'      => '學期長度不可超過2字',
        'DayfgID.integer'   => '請選擇部別',
        'DayfgID.unique'    => '該學年學期部別資料已重複',
    );

    //新增時產生UUID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if (!$model->SettleDateBatchID) {
            //     // only set a UUID on first creation and if not already set
            //     $model->SettleDateBatchID = (string) Str::uuid();
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

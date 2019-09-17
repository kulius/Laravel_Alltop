<?php

namespace Modules\M03\Http\Controllers;

use App\Alltop\BaseModel;
use App\Database\eOffice\SysBoard;
use App\Database\eOffice\SysBoardClass;
use App\Database\eOffice\SysBoardTemplate;
use App\Database\UPLOAD\ITFILE;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class m03120Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(array('at.auth'));
    }

    public function index(Request $request)
    {
        /*
        Mail::send('mail', array(), function ($message) {
        $to='keyingan0916@gmail.com';
        $message->to($to)
        ->subject('先傑電腦');
        });
         */

        $event = $request->event;

        if ($event == 'remove') {
            $tb_sel = json_decode($request->tb_sel, true);
            $tb_sel = ($tb_sel ? $tb_sel : array());
            $tb_del = array_map(function ($item) {return $item['seq'];}, $tb_sel);

            $result = SysBoard::whereIn('seq', $tb_del)->delete();

            if ($result) {
                Session::flash('sweet', array('success', _i('資料刪除成功！')));
            } else {
                Session::flash('sweet', array('error', _i('資料刪除失敗！')));
            }
        }

        $where = array();

        $board_number = (isset($request->board_number) ? $request->board_number : null);

        if ($board_number) {
            $where[] = array('board_number', 'like', '%' . $board_number . '%');
        }

        $data_main = SysBoard::where($where)->get();

        return view('m03::m03120.index', array(
            'data_main' => $data_main,
        ));
    }

    public function view(Request $request, $status, $board_number = null)
    {
        // 公告內容
        $where   = array();
        $where[] = array('board_number', $board_number);

        $data_main = SysBoard::where($where)->first();

        // 附件資料
        $where   = array();
        $where[] = array('form_number', $board_number);

        $data_file = ITFILE::where($where)->get();

        return view('m03::m03120.view', array(
            'status'    => $status,
            'data_main' => $data_main,
            'data_file' => $data_file,
        ));
    }

    public function save(Request $request, $status, $board_number = null)
    {
        $event = $request->event;
        $data  = $request->all();

        if ($event === 'save') {
            if ($status === 'add') {
                //公告代碼
                $year      = (date('Y') - 1911);
                $user_unit = session('user_unit');
                $prefix    = $year . $user_unit;

                $filter   = array();
                $filter[] = array('board_number like ?', $prefix . '%');

                $filters = BaseModel::setWhere($filter);
                $where   = $filters["where"];
                $param   = $filters["param"];

                $sql = "
                    SELECT RIGHT(MAX(board_number), 4) AS board_number_max
                    FROM tSysBoard
                    WHERE {$where}";
                $data_board = DB::connection('eOffice')->select($sql, $param);

                $board_number = (isset($data_board[0]['board_number_max']) ? $data_board[0]['board_number_max'] : 0);
                $board_number = $prefix . str_pad(($board_number + 1), 4, 0, STR_PAD_LEFT);

                $data['board_number']    = $board_number;
                $data['ins_user_number'] = session('user_number');
                $data['ins_user_unit']   = session('user_unit');
            }

            if ($status === 'edit') {
                $data['upd_user_number'] = session('user_number');
                $data['upd_datetime']    = date('Y-m-d H:i:s');
            }

            //$data['board_status'] = implode('|', $data['board_status']);
            $data['board_type'] = implode('|', $data['board_type']);

            $result = SysBoard::updateOrCreate(array('board_number' => $board_number), $data);

            //附件上傳
            ITFILE::save_file($_FILES['board_file'], $result->board_number);

            if ($result) {
                Session::flash('sweet', array('success', _i('動作執行成功！')));
            } else {
                Session::flash('sweet', array('error', _i('動作執行失敗！')));
            }

            $status       = 'edit';
            $board_number = $result->board_number;
        } else if ($event === 'remove') {
            $tb_sel = json_decode($request->board_file_tb_sel, true);
            $result = ITFILE::remove_file($tb_sel);

            if ($result) {
                Session::flash('sweet', array('success', _i('資料刪除成功！')));
            } else {
                Session::flash('sweet', array('error', _i('資料刪除失敗！')));
            }
        }

        return redirect()->route('m03120_view', array($status, $board_number));
    }

    public function index_jump(Request $request)
    {
        $event = $request->event;

        if ($event == 'select') {
            $tb_sel = json_decode($request->tb_sel, true);
            $tb_sel = ($tb_sel ? $tb_sel : array());

            if ($tb_sel) {
                $where   = array();
                $where[] = array('seq', $tb_sel[0]['seq']);

                $data = SysBoardTemplate::where($where)->first();

                ?>
                <script>
                    var board_title = parent.document.getElementById('board_title');
                    var board_content = parent.CKEDITOR.instances['board_content'];

                    board_title.value = '<?php echo $data['board_template_title'] ?>';
                    board_content.setData('<?php echo $data['board_template_content'] ?>');

                    //關閉modal
                    parent.setModalClose();
                </script>
                <?php
} else {
                Session::flash('sweet', array('error', _i('未選取任何資料！')));
            }
        }

        $filter  = array();
        $filters = BaseModel::setWhere($filter);
        $where   = $filters["where"];
        $param   = $filters["param"];

        $sql = "
            SELECT *
            FROM (
                SELECT a.*, b.board_class_name
                FROM tSysBoardTemplate a
                LEFT JOIN tSysBoardClass b ON a.board_class_seq = b.seq
            ) a
            WHERE {$where}";
        $data_main = DB::connection('eOffice')->select($sql, $param);

        // 範本類別
        $where   = array();
        $where[] = array('board_class_status', '1');

        $data_board_class = SysBoardClass::select(array(
            'seq AS value',
            'board_class_name AS text',
        ))
            ->where($where)
            ->get();

        return view('m03::m03120.jump', array(
            'data_main'        => $data_main,
            'data_board_class' => $data_board_class,
        ));
    }
}

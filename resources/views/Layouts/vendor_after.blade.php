@inject('View', 'App\Alltop\BaseView')

@php
    if (is_array(session('sweet'))) {
        $aSweet = session()->pull('sweet', 'default');
        echo $View->setSwal(array("type" => $aSweet[0], "msg" => $aSweet[1], "style" => "alert"));
    }
@endphp

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Slimscroll -->
<script src="/dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<!-- Bootstrap Select -->
<script type="text/javascript" src="/addons/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/addons/bootstrap-select/dist/js/i18n/defaults-zh_TW.min.js"></script>

<!-- Bootstrap File Input -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>

<!-- CKEditor -->
<script type="text/javascript" src="/addons/ckeditor/ckeditor.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="/addons/datatables/datatables.js"></script>
<script type="text/javascript" src="/addons/datatables-edit/js/dataTables.editor.js"></script>

<script>
$("#sidebar").slimScroll({
    height: '100%',
    alwaysVisible: true,
});

$.fn.dataTable.Buttons.defaults.dom.button.className = "btn btn-outline-dark";
$.fn.dataTable.Editor.classes.form.button = "btn btn-outline-dark";

var FormLock = false;
var FormStatus = '';

$(document).ready(function () {

    /*alert(FormStatus);*/
    setDefWork();
});

$(window).resize(function () {
    refDataTables();
});

function setDefWork() {
    bsCustomFileInput.init()

    var LockStatus = ["edit", "new"];

    $("a[data-toggle='tab']").on("shown.bs.tab", function (e) {
        localStorage.setItem("activeTab", $(e.target).attr('href'));

        $.fn.dataTable.tables({ visible: true, api: true })
        .columns.adjust()
        .responsive.recalc()
        .draw();
    });

    var activeTab = localStorage.getItem("activeTab");

    if(activeTab) { $('.nav-tabs a[href="' + activeTab + '"]').tab('show'); }

    //控件偵測
    if ($.inArray(FormStatus, LockStatus) > -1) {
        $("input").on("change", function () { FormLock = true; });
        $("select").on("change", function () { FormLock = true; });
        $("textarea").on("change", function () { FormLock = true; });
    }
}

function setHref(Url) {
    if (FormLock) {
        var SwalFire = {
            html: "資料若未「儲存」，系統可能不會儲存您所做的變更！",
            type: "question",
            title: "是否離開此頁面？",
            footer: "當前畫面，已偵測到資料異動行為！",
            showCancelButton: true,
        };

        setSweetAlert(SwalFire, Url, "href");
    } else {
        Loading();
        document.location.assign(Url);
        LoadingClose();
    }
}

function setSubmit(e) {
    if ($(e.form).valid() || e.value === "remove") {
        Loading();
        $("<input />").attr("type", "hidden").attr("name", e.name).attr("value", e.value).appendTo(e.form);
        e.form.submit();
    } else {
        var SwalFire = {
            html: "請確認輸入資料正確性！",
            type: "error",
            title: "動作執行失敗",
        };

        setSweetAlert(SwalFire);
    }
}

function setLang(lang) {
    $("<input />").attr("type", "hidden").attr("name", "lang_item").attr("value", lang).appendTo($("#language"));

    $("#language").submit();
    /*
    language = document.getElementsByName("language");
alert('sss');
    $("<input />").attr("type", "hidden").attr("name", "lang_item").attr("value", lang).appendTo(language);

    language.submit();
    */
}

//HTML過濾
function FilterHtml(Str) {
    var reg = /<[^>]+>/g;

    return reg.test(Str);
}

//DataTables
function setDataTables(ID, Set, Sel) {
    var SelID = ID + "_sel";

    $("#" + ID).append("<input type='hidden' id='" + SelID + "' name='" + SelID + "'>");

    var SelElem = document.getElementById(SelID);

    $.each(Set["buttons"], function (kBtns, vBtns) {
        if(vBtns["action"] != null){
            switch (vBtns["action"]) {
                case "remove":
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", "remove");

                        setSubmit(btn);
                    };
                    break;
                case "select":
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", "select");

                        setSubmit(btn);
                    };
                    break;
                case "stop":
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", "stop");

                        setSubmit(btn);
                    };
                    break;
                default:
                    var vBtn = vBtns["action"];
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", vBtn);

                        setSubmit(btn);
                    };
            }
        }

    });

    var Table = $("#" + ID).DataTable(Set);

    if (Sel.length != 0) {
        Table.rows(Sel).select();

        var DataInfo = Table.rows( { selected: true } ).data().toArray();
        var DataSel = [];

        $.each(DataInfo, function (kSel, vSel) {
            var DataObj = {};

            $.each(vSel, function (kData, vData) {
                if (vData && !(FilterHtml(vData))) {
                   DataObj[kData] = vData;
                }
            });

            DataSel.push(DataObj);
        });

        SelElem.value = JSON.stringify(DataSel);
    }



    Table.on( "select", function (e, dt, type, indexes) {
        var DataInfo = Table.rows( { selected: true } ).data().toArray();
        var DataSel = [];

        $.each(DataInfo, function (kSel, vSel) {
            var DataObj = {};

            $.each(vSel, function (kData, vData) {
                if (vData && !(FilterHtml(vData))) {
                   DataObj[kData] = vData;
                }
            });

            DataSel.push(DataObj);
        });

        SelElem.value = JSON.stringify(DataSel);
    });

    Table.on( "deselect", function (e, dt, type, indexes) {
        var DataInfo = Table.rows( { selected: true } ).data().toArray();
        var DataSel = [];

        $.each(DataInfo, function (kSel, vSel) {
            var DataObj = {};

            $.each(vSel, function (kData, vData) {
                if (vData && !(FilterHtml(vData))) {
                   DataObj[kData] = vData;
                }
            });

            DataSel.push(DataObj);
        });

        if (DataSel.length === 0) {
            SelElem.value = null;
        } else {
            SelElem.value = JSON.stringify(DataSel);
        }
    });
}

function setDataTablesEditor(ID, EditSet, Set) {
    var InsOrUpdID = ID + "_ins_upd";
    var DelID = ID + "_del";

    $("#" + ID).append("<input type='hidden' id='" + InsOrUpdID + "' name='" + InsOrUpdID + "'>");
    $("#" + ID).append("<input type='hidden' id='" + DelID + "' name='" + DelID + "'>");

    var InsOrUpdElem = document.getElementById(InsOrUpdID);
    var InsOrUpd = [];

    var DelElem = document.getElementById(DelID);
    var Del = [];

    var editor = new $.fn.dataTable.Editor( {
        table: "#" + ID,
        idSrc: "DT_RowId",
        fields: EditSet,
        i18n: {
            create: {
                title:  "資料新增",
                submit: "儲存"
            },
            edit: {
                title:  "資料編輯",
                submit: "儲存"
            },
            remove: {
                title:  "資料刪除",
                submit: "刪除",
                confirm: "是否刪除資料？（共選擇 %d 筆資料）",
            },
            error: {
                system: "動作執行失敗，請重新整理頁面後，再次嘗試！"
            },
            datetime: {
                months:   [ "一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                weekdays: [ "一", "二", "三", "四", "五", "六", "七" ]
            },
            multi: {
                title: "資料含有多個值",
                info: "所選資料，該欄位含有複數值，若確認要將其同步，請點擊此處方可編輯！",
                restore: "取消同步",
                noMulti: "動作執行失敗，請重新整理頁面後，再次嘗試！"
            },
        }
    });

    //新增後觸發
    editor.on("create", function (e, json, data) {
        InsOrUpd.push(data);

        InsOrUpdElem.value = JSON.stringify(InsOrUpd);
    });

    //刪除前觸發
    editor.on("preRemove", function (e, json, ids) {
        var SelInfo = Table.rows( { selected: true } ).data().toArray();
        var Sel = [];
        var Tmp = [];

        $.each(SelInfo, function (kSel, vSel) {
            var DataObj = {};

            $.each(vSel, function (kData, vData) {
                if (vData && !(FilterHtml(vData))) {
                   DataObj[kData] = vData;
                }
            });

            $.each(InsOrUpd, function (kIns, vIns) {
                if (!(vSel["DT_RowId"] === vIns["DT_RowId"])) {
                    Tmp.push(InsOrUpd[kIns]);
                }
            });

            if (isNaN(vSel["DT_RowId"])) {
                Sel.push(DataObj);
            }
        });

        InsOrUpd = Tmp;

        DelElem.value = JSON.stringify(Sel);
        InsOrUpdElem.value = JSON.stringify(InsOrUpd);
    });

    editor.on("preSubmit", function (e, data, action) {
        FormLock = true;
    });

    /*
    editor.on("preSubmit", function (e, data, action) {
        var Data = data["data"];

        $.each(Data, function (kData, vData) {
             alert(kData);
            alert( JSON.stringify(vData));
            switch (action) {
                case "add":
                    break;
                case "edit":
                    break;
                case "remove":
                    break;
            }
        });
    });
    */

    //編輯後觸發
    editor.on("edit", function (e, json, data, id) {
        var InArray = false;

        $.each(InsOrUpd, function (key, value) {
            if (data["DT_RowId"] === value["DT_RowId"]) {
                InsOrUpd.splice(key, 1, data);
                InArray = true;
            }
        });

        if (!InArray) {
            InsOrUpd.push(data);
        }

        InsOrUpdElem.value = JSON.stringify(InsOrUpd);
    });

    if(Set["inline"]){
        $("#" + ID).on("click", "tbody td:not(:first-child)", function (e) {
            editor.inline(this, {
                onBlur: "submit"
            });
        });
    }


    $.each(Set["columns"], function (kCols, vCols) {
        if (typeof(vCols["render"]) === "object") {
            if (Object.keys(vCols["render"]).length > 0) {
                var Option = vCols["render"];

                vCols["render"] = function(val, type, row) {
                    var Value = "";

                    $.each(Option, function (kOption, vOption) {
                        if (val === vOption["value"]) {
                            Value = vOption["text"];
                        }
                    });

                    return Value;
                }
            }
        }

    });

    $.each(Set["buttons"], function (kBtns, vBtns) {
        switch (vBtns["extend"]) {
            case "create":
            case "edit":
            case "remove":
                vBtns["editor"] = editor;
                break;
        }

        if(vBtns["action"] != null){
            switch (vBtns["action"]) {
                case "save":
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", "save");

                        setSubmit(btn);
                    };
                    break;
                case "filter":
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        $('#collapseExample').collapse('toggle');
                    };
                    break;
                default:
                    var vBtn = vBtns["action"];
                    vBtns["action"] = function (e, dt, node, config) {
                        var btn = e["currentTarget"];
                        btn.setAttribute("name", "event");
                        btn.setAttribute("value", vBtn);

                        setSubmit(btn);
                    };
            }
        }
    });

    var Table = $("#" + ID).DataTable(Set);
}

function refDataTables() {
    var Table = $(".data-table").DataTable();

    setTimeout(
        function () {
            Table.responsive.recalc();
            Table.columns.adjust().draw();
        }
    , 100);
}

//檔案上傳
function setFileInput(Elem, Set) {
   $.extend(Set, {
        theme: 'fas',
        showUpload: false,
        showCaption: false,
        dropZoneEnabled: false,
        enableResumableUpload: true,
        uploadUrl: '/',
        fileActionSettings: {
            showZoom: function(config) {
                if (config.type === 'pdf' || config.type === 'image') {
                    return true;
                }
                return false;
            },
            showUpload: false
        }
    });

    $("#" + Elem).fileinput(Set);
}

//DateTimePicker
function setDateTimePicker(Elem, Set) {
    $.extend(Set, {
        buttons: {
            showClear: true,
            showClose: true
        },
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'fas fa-trash',
            close: 'fas fa-times'
        }
    });

    $(Elem).datetimepicker(Set);
}

function setDateTimePickerClose(e) {
    $("#" + e.id).datetimepicker("hide");
}

//SweetAlert
function setSweetAlertTime(SwalFire, Content, Act) {
    Swal.fire(
        SwalFire
    ).then(function (result) {
        switch (Act) {
            case "href":
                document.location.href = Content;
                break;
        }
    })
}

function setSweetAlert(SwalFire, Content, Act) {
    $.extend(SwalFire, {
        confirmButtonText: "確認",
        cancelButtonText: "取消",
        /*
        buttonsStyling: false,
        confirmButtonClass: "btn btn-info btn-lg btn-block",
        cancelButtonClass: "btn btn-danger btn-lg btn-block",
        */
    });

    Swal.fire(
        SwalFire
    ).then(function (result) {
        if (result.value) {
            switch (Act) {
                case "href":
                    Loading();
                    document.location.replace(Content);
                    break;
            }
        }
    })
}

//Logout
function setLogout() {
    var SwalFire = {
        type: "question",
        title: "是否執行登出系統？",
        showCancelButton: true,
    };

    setSweetAlert(SwalFire, "../index.php", "href");
}

//Bootstrap Select
function refDropDown() {
    $(".selectpicker").selectpicker("refresh");
}

//Model
function setModalOpen(Var) {
    var data = jQuery.parseJSON(Var);

    let param = "?head=" + data.head + "&href=" + data.href;
    $("#modal").load("{{ route('modal_default') }}" + param, function (){
        $(this).modal("show");
    });
}

function setModalClose() {
    $("#modal").modal("hide");
}
</script>

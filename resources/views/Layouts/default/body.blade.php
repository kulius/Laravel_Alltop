<body class="layout-3" onload="LoadingClose();" style="min-height: 100vh;">
    <div id="app">
        <div class="modal fade" role="dialog" id="modal"></div>

        <div class="main-wrapper main-wrapper-1">
            <div class="main-wrapper container">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <div class="login-logo">
                        <a href="" class="navbar-brand sidebar-gone-hide"><img></a>
                    </div>

                    <a href="#" class="sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"
                            style="font-size: 1.5rem;color: #FFFFFF"></i></a>

                    <!--
                    <div class="nav-collapse">
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>

                        <ul class="navbar-nav">
                            <li class="nav-item active"><a href="#" class="nav-link">Application</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Report Something</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Server Status</a></li>
                        </ul>

                    </div>
                    -->

                    <form class="form-inline ml-auto">
                        <!--
                        <ul class="navbar-nav">
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>

                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            <div class="search-backdrop"></div>
                            <div class="search-result">
                                <div class="search-header">
                                    Histories
                                </div>
                                <div class="search-item">
                                    <a href="#">How to hack NASA using CSS</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-item">
                                    <a href="#">Kodinger.com</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-item">
                                    <a href="#">#Stisla</a>
                                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="search-header">
                                    Result
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                                        oPhone S9 Limited Edition
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                                        Drone X2 New Gen-7
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                                        Headphone Blitz
                                    </a>
                                </div>
                                <div class="search-header">
                                    Projects
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <div class="search-icon bg-danger text-white mr-3">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        Stisla Admin Template
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <div class="search-icon bg-primary text-white mr-3">
                                            <i class="fas fa-laptop"></i>
                                        </div>
                                        Create a new Homepage Design
                                    </a>
                                </div>
                            </div>
                        </div>
                        -->
                    </form>

                    <ul class="navbar-nav navbar-right">
                        <!--
                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Messages
                                    <div class="float-right">
                                        <a href="#">Mark All As Read</a>
                                    </div>
                                </div>
                                <div class="dropdown-list-content dropdown-list-message">
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                                            <div class="is-online"></div>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Kusnaedi</b>
                                            <p>Hello, Bro!</p>
                                            <div class="time">10 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Dedik Sugiharto</b>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                            <div class="time">12 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                                            <div class="is-online"></div>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Agung Ardiansyah</b>
                                            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <div class="time">12 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Ardian Rahardiansyah</b>
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                            <div class="time">16 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-avatar">
                                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Alfa Zulkarnain</b>
                                            <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                            <div class="time">Yesterday</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Notifications
                                    <div class="float-right">
                                        <a href="#">Mark All As Read</a>
                                    </div>
                                </div>
                                <div class="dropdown-list-content dropdown-list-icons">
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-icon bg-primary text-white">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Template update is available now!
                                            <div class="time text-primary">2 Min Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                            <div class="time">10 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-success text-white">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                            <div class="time">12 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-danger text-white">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Low disk space. Let's clean it!
                                            <div class="time">17 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Welcome to Stisla template!
                                            <div class="time">Yesterday</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        -->

                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                                <img alt="image" src="" class="rounded-circle mr-1">

                                <div class="d-sm-none d-lg-inline-block">Hi ~ </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item has-icon text-danger" onclick="setLogout();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <nav class="navbar navbar-secondary navbar-expand-lg">
                    <div class="container">
                        <ul class="navbar-nav">
                            @foreach ($navbar as $data)
                            <li class='nav-item'>
                                <a href='/guide/{{ $data->param_content }}' class='nav-link'>
                                    <i class='far fa-clone'></i>
                                    <span>{{ $data->param_remark }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </nav>


                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>
                               {{--  <button type="button" class="btn btn-outline-dark border border-white mb-1 rounded-circle" onclick="setHref('/2019/ms01/czAxMDAwX0hvbWU=@eyJpbmRleCI6Im1zMDFcL3MwMTAwMF9Ib21lIiwiZmF2IjoiczAxMDAwIn0=');">
                                    <i class="far fa-star" style="font-size: 1.5rem;"></i>
                                </button> --}}
                                @empty($aBread)
                                功能導引
                                @endif
                            @if($aBread)
                                {{ $aBread[2] }}
                            </h1>
                                <div class="section-header-breadcrumb">
                                    <div class="breadcrumb-item"><a href=""></a>{{ $aBread[0] }}</div>
                                    <div class="breadcrumb-item">{{ $aBread[1] }}</div>
                                    <div class="breadcrumb-item">{{ $aBread[2] }}</div>
                                </div>
                            @endif
                        </div>
                        <div class="container mt-1">
                            @yield('content')
                        </div>
                    </section>
                </div>

                <!--
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                    </div>
                    <div class="footer-right">

                    </div>
                </footer>
            -->
            </div>
        </div>
    </div>

    @inject('View', 'App\Alltop\BaseView')

    @php
        if (is_array(session('sweet'))) {
            $aSweet = session()->pull('sweet', 'default');
            echo $View->setSwal(array("type" => $aSweet[0], "msg" => $aSweet[1], "style" => "alert"));
        }
    @endphp

    @include('layouts.vendor_after')

    <script type="text/javascript">
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
</body>

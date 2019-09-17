<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content={{csrf_token()}}>

<title>校園e化</title>

<link rel="stylesheet" href="/css/app.css"></link>

<!-- Theme style -->
<link rel="stylesheet" href="/dist/css/adminlte.min.css">

<!-- Skin -->
<link rel="stylesheet" href="/skin/ntue/style.css?<?php echo date('Y-m-d H:i:s') ?>">

<!-- Font Awesome（ICON）-->
<link rel="stylesheet" href="/addons/fontawesome/css/all.css">

<!-- DataTables -->
<link rel="stylesheet" href="/addons/datatables/datatables.css">
<link rel="stylesheet" href="/addons/datatables-edit/css/editor.dataTables.css">

<!-- jQuery -->
<script src="/dist/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Select -->
<link rel="stylesheet" type="text/css" href="/addons/bootstrap-select/dist/css/bootstrap-select.min.css">

<!-- moment.js FOR tempusdominus/bootstrap4 For DatePicker -->
<script src="/addons/moment.min.js"></script>

<!-- tempusdominus/bootstrap-4 -->
<link rel="stylesheet" href="/addons/tempusdominus/bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css" />
<script type="text/javascript" src="/addons/tempusdominus/moment/locale/zh-tw.js"></script>
<script type="text/javascript" src="/addons/tempusdominus/bootstrap-4/build/js/tempusdominus-bootstrap-4.js"></script>

<!-- SweetAlert2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- busy-load -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>

<!-- Jquery Validata -->
<script src="/addons/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/addons/jquery-validation/dist/additional-methods.min.js"></script>
<script src="/addons/jquery-validation/dist/localization/messages_zh_TW.js"></script>

<!-- Bootstrap File Input -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- iCheck -->
<link rel="stylesheet" href="/addons/icheck-material/icheck-material.min.css">
<link rel="stylesheet" href="/addons/icheck-material/icheck-material-custom.min.css">

@yield('css')

<script type="text/javascript">
    Loading();

    function Loading() {
        $("html").animate({ scrollTop: 0 }, "slow");

        $("html").busyLoad("show", {
            spinner: "circles",
            //color: "red",
            text: "Loading",
            textPosition: "bottom",
            textColor: "white",
        });
    }

    function LoadingClose() {
        $("html").busyLoad("hide");
    }

    function tab_Loading(){
        $("#tabs-shadow").animate({ scrollTop: 0 }, "slow");

        $("#tabs-shadow").busyLoad("show", {
            spinner: "circles",
            //color: "red",
            text: "Loading",
            textPosition: "bottom",
            textColor: "white",
        });
    }

    function tab_LoadingClose() {
        $("#tabs-shadow").busyLoad("hide");
    }
</script>
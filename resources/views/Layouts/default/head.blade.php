<head>
     @include('layouts.vendor_before')

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
</head>

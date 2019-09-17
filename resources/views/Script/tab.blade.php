<script>
    $(function(){
      setDefWork();
      var showList = [];
      //預先載入第一個頁籤
      var active = $("#nav_tabs li a.active");
      console.log(active);
      if(showList.indexOf(active.attr('href')) == -1){
        tab_Loading(); 
        var loadurl = active.attr('data-url');
        var target = active.attr('href');
        $.get(loadurl, function(data){
              $(target).html(data);
              tab_LoadingClose();
          });
        showList.push(active.attr('href'));
       
      }
    
      $("#nav_tabs li a").click(function(e){
        var loadurl = $(this).attr('data-url');
        var target = $(this).attr('href');
    
        if(showList.indexOf(target) != -1){
          $(this).tab('show');
          console.log(target);
          return false;
        }
        console.log(showList);
    
          tab_Loading(); 
          console.log(target.hash);
          console.log(loadurl);
          
          $.get(loadurl, function(data){
           // console.log($(target));
            $(target).html(data);
            tab_LoadingClose();
            showList.push(target);
          });
          
          $(this).tab('show');
          return false;
      });
    });
    </script>
    
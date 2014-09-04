<script src="./js/jquery.min.js"></script>
<script src="./js/modernizr.custom.js"></script>
<script src="./js/classie.js"></script>
<script src="./js/uisearch.js" type="text/javascript" charset="utf-8"></script>

<script>
    new UISearch( document.getElementById( 'sb-search' ) );
    $("#minebtn").hover(
            function(){
               $(".lgnhover").show();
    },
            function(){
                $(".lgnhover").hide();
            }
    );
    $(".lgnhover").hover(
            function(){
                $(this).show();
            },
            function(){
                $(this).hide();
            }
    );
	
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fd2289fe0f6d090638e4fa53929e4b152' type='text/javascript'%3E%3C/script%3E"));


</script>
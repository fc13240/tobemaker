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
</script>
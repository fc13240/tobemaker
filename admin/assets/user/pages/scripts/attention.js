var divManaged = function () {

    var attentionProcessUrl;
   
    var length=24;
// 更改页面内容
    var initdiv = function (  data, type) {
        
        var div ;
		if(type=='my')
		{
		    div=$("#myattentionList");
		}
		else
		{
		     div=$("attentionmeList");
		}
        var list=data["data"];
       
		for(var i in list)
		{
		    var html='<dl><dd><a href="#"><img src="'+i[2]+'" alt=""></dd><dd><a>'+i[1]+'</a></dd></dl>';
			div.append(html);
		}
		var total=data.recordsTotal;
		
		if(type=='my')
		{
		var foot='<div class="prev-my" id="minelistprev"><div><a href="#"><</a></div><input type="hidden" id="myprevstart" value="'+(data.start-length>0?data.start-legth:1)+'"/></div><div class="next-my" id="minelistnext"><div><a href="#">></a></div><input type="hidden" id="mynextstart" value="'+(data.start+length>total?data.start:data.start+length)+'"/></div><br class="clear"/>';
		div.append(foot);
		}
		else
		{
		      var foot='<div class="prev-me" id="minelistprev"><div><a href="#"><</a></div><input type="hidden" id="meprevstart" value="'+(data.start-length>0?data.start-legth:1)+'"/></div><div class="next-me" id="minelistnext"><div><a href="#">></a></div><input type="hidden" id="menextstart" value="'+(data.start+length>total?data.start:data.start+length)+'"/></div><br class="clear"/>';
		div.append(foot);
		}
        }
  
//注册点击向后翻页事(我的关注)
$('.next-my').click(function()
{
var userid=$('#userid').val();
var start=$('#mynextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'my');
                   
            },'json');
});
//注册点击向前翻页事（我的关注）
$('.prev-my').click(function()
{
var userid=$('#userid').val();
var start=$('#myprevstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'my');
                    
            },'json');
});
//注册点击向后翻页事(关注我的)
$('.next-me').click(function()
{
var userid=$('#userid').val();
var start=$('#menextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-attention-me', 'attention_userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'me');
                   
            },'json');
});
//注册点击向前翻页事（关注我的）
$('.prev-me').click(function()
{
var userid=$('#userid').val();
var start=$('#meprevstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-attention-me', 'attention_userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'me');
                    
            },'json');
});
    return {

        //main function to initiate the module
        init: function () {
		
     var userid=$('#userid').val();
     var start=1;
     $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'my');
                    
            },'json');
           
        }

    };

}();

<!DOCTYPE html>
<?php include ('int.php');?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta charset="UTF-8">
<meta name="referrer" content="Origin">
<meta name="referrer" content="never" />
<meta name="referrer" content="no-referrer"/>
<title>爱美剧播放器</title>
<link rel="shortcut icon" href="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/img/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/css/yzmplayer.css">
<style> 
.yzmplayer-full-in-icon{display: none!important;}
.yzmplayer-full-icon span svg,.yzmplayer-fulloff-icon span svg{display: none;}
.yzmplayer-full-icon span,.yzmplayer-fulloff-icon span{background-size:contain!important;float: left;width: 22px;height: 22px;}
.yzmplayer-full-icon span{background: url(//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/img/full.png) center no-repeat;}
.yzmplayer-fulloff-icon span{background: url(//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/img/fulloff.webp) center no-repeat;}
#loading-box{background: #<?php echo($_GET['color']);?>!important;}
#vod-title{overflow: unset;width: 285px;white-space: normal;color: #fb7299;}
#vod-title e{padding: 2px;}
.layui-layer-dialog{text-align: center;font-size: 16px;padding-bottom: 10px;}
.layui-layer-btn.layui-layer-btn-{padding: 15px 5px !important;text-align: center;}
.layui-layer-btn a{font-size: 12px;padding: 0 11px !important;}
.layui-layer-btn a:hover{border-color: #00a1d6 !important;background-color:#00a1d6 !important;color: #fff !important;}
.yzmplayer-controller .yzmplayer-icons .yzmplayer-toggle input+label.checked:after{left: 17px;}
.yzmplayer-setting-jlast:hover #jumptime,.yzmplayer-setting-jfrist:hover #fristtime{display: block;outline-style: none}
#player_pause .tip{color: #f4f4f4;position: absolute;font-size: 14px;background-color: hsla(0, 0%, 0%, 0.42);padding: 2px 4px;margin: 4px;border-radius: 3px;right: 0;}
#player_pause{position: absolute;z-index: 9999;top: 50%;left: 50%;border-radius: 5px;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);transform: translate(-50%,-50%);max-width: 80%;max-height: 80%;}
#player_pause img{width: 100%;height: 100%;}
#jumptime::-webkit-input-placeholder,#fristtime::-webkit-input-placeholder{color: #ddd;opacity: .5;border: 0;}
#jumptime::-moz-placeholder{color: #ddd;}
#jumptime:-ms-input-placeholder{color: #ddd;}
#jumptime, #fristtime{width: 50px;border: 0;background-color: #414141;font-size: 12px;padding: 3px 3px 3px 3px;margin: 2px;border-radius: 12px;color: #fff;position: absolute;left: 5px;top: 3px;display: none;text-align: center;}
#link{display: inline-block;width: 100px;height: 35px;line-height: 35px;text-align: center;font-size: 14px;border-radius: 22px;margin: 0px 10px;color: #fff;overflow: hidden;box-shadow: 0px 2px 3px rgba(0,0,0,.3);background: rgb(0, 161, 214);position: absolute;z-index: 9999;top: 20px;right: 35px;}
#close c{float: left;display: none;}
.dmlink,.playlink,.palycon{float: left;width: 400px;}
#link3-error{display: none;}
#stats{position:fixed;top:5px;left:8px;font-size:12px;color:#fdfdfd;text-shadow:1px 1px 1px #000, 1px 1px 1px #000}
</style>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/yzmplayer.js"></script>
<script src="//cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/md5.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/setting.js"></script>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/layer.js"></script>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/flv.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/wowo344/wxtvnet@1.9.8/djplayer/asset/js/hls.min.js"></script>
    <?php
 
    if(isset($_GET["vodname"]))//如果存在vodname， 则使用vodname
    {
        //$id=substr(md5($_GET['vodname']), -20);
        $id=strip_tags($_GET['vodname']);
    }
    else {
        $id=substr(md5($_GET['url']), -20);
    }
    ?>
<script>
    function switchJi()
    {
        try{
              var url=$('.selected', window.parent.document).next().attr('href');
                if(url!=null)
                {
                    window.top.location.href='https://www.meiju56.com'+url;
                }
        }catch(e){
            console.log(e);
            $('#link3-error').html('切换失败，请尝试手动切换线路。');
        }
      
    }
</script>
</head>
<body>
<div id="loading-box"><div class="loading"><p class="pic"></p><div class="tips"></div></div><div type="button" id="close" >
    <div class="playlink"><span id="link1"style="display: inline!important;">播放器连接【完成】</span>
    <!--<span id="link1-success">【完成】</span>-->  
    </div>
    <div class="dmlink"><span id="link2">弹幕连接中...</span><span id="link2-success">【完成】</span><span id="link2-error">【失败】</span></div><span class="palycon" id="link3"><e id="link3_tip">等待视频连接中</e><e id="link3-error">【失败！请<a href='javascript:window.top.location.reload()'>刷新</a>重试 或 <a href='javascript:switchJi()'>点击切换线路</a>】</e><!--d class="wait"><e id="span">3</e>s</d--></span></div></div>
<div id="player"></div>
<div id="ADplayer"></div>
<div id="ADtip"></div>
<div id="stats"></div><script>
var vname=$('.text-fff', window.parent.document).html();
if(vname==null)
{
    vname="<?php echo ($id); ?>";
}

var config = {
	"api":'dmku/',//弹幕接口
	"av":'<?php echo($_GET['av']);?>',//B站弹幕id 45520296
	"url":"<?php echo ($_GET['url']);?>",//视频链接
	//"id":"<?php echo($_GET['name']);?>",//视频id
	//"id": "<?php echo ($id); ?>", //视频id
	"id": vname, //视频id
	"sid":"<?php echo($_GET['sid']);?>",//集数id
	"pic":"<?php echo($_GET['pic']);?>",//视频封面
	"title":"",//视频标题
	//"title":"<?php echo($_GET['name']);?>",//视频标题
	"next":"<?php echo($_GET['next']);?>",//下一集链接
	"user": '<?php echo($_GET['user']);?>',//用户名
	"group": "3",//用户组
	}
var up = {
	"usernum":"<?php include("asset/tj.php"); ?>",//在线人数
	"mylink":"https://www.meiju56.com",//域名
	"diyid": [0, '游客', 1] //自定义弹幕id
	//"diyid":[0,md5(config.url),1]//自定义弹幕id
	}
YZM.start()
</script>
</body>
<iframe src="" marginwidth="0" marginheight="0" width="0" height="0"  border="0" scrolling="no" frameborder="0" ></ifram>
</html>
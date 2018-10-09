<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CRM登录</title>
<link rel="stylesheet" type="text/css" href="admin/css/public.css" />
<link rel="stylesheet" type="text/css" href="admin/css/page.css" />
<script type="text/javascript" src="admin/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="admin/js/public.js"></script>
<script type="text/javascript" src="admin/layui/layui.js"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead">
		<img src="admin/img/logLOGO.png"/>
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<div class="logDiv">
		<img class="logBanner" src="admin/img/logBanner.png" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录</p>
				<p class="p2">CRM管理员登录</p>
			</div>
			<!-- 输入框 -->
			<div class="lgD">
				<img class="img1" src="admin/img/logName.png" /><input class="name" type="text"
					placeholder="输入用户名" />
			</div>
			<div class="lgD">
				<img class="img1" src="admin/img/logPwd.png" /><input class="pwd" type="text"
					placeholder="输入用户密码" />
			</div>
			{{--<div class="lgD logD2">--}}
				{{--<input class="getYZM" type="text" />--}}
				{{--<div class="logYZM">--}}
					{{--<img class="yzm" src="admin/img/logYZM.png" />--}}
				{{--</div>--}}
			{{--</div>--}}
			<div class="logC">
				<button>登 录</button>
			</div>
		</div>
	</div>
	<!-- 登录body  end -->

	<!-- 登录页面底部 -->
	<div class="logFoot">
		<p class="p1">版权所有：南京设易网络科技有限公司</p>
		<p class="p2">南京设易网络科技有限公司 登记序号：苏ICP备11003578号-2</p>
	</div>
	<!-- 登录页面底部end -->
</body>
</html>
<script type="text/javascript">
	layui.use(['layer'],function(){
		var layer = layui.layer;
		$('button').click(function(){
			var name = $('.name').val();
			if( name == '' ){
				layer.msg('请填写用户名！',{icon:0});
				return false;
			}
			var pwd = $('.pwd').val();
			if( pwd == '' ){
				layer.msg('请填写密码！',{icon:0})
				return false;
			}
			var index = layer.load(0,{time:10*1000});
			$.ajax({
				url:'/loginDo',
				data:'name='+name+'&pwd='+pwd+'&_token='+'{{csrf_token()}}',
				dataType:'json',
				type:'post',
				async:false,
				success:function(json_info){
					if( json_info.status == 1000 ){
						layer.msg(json_info.msg,{icon:6,time:1000},function(){
							window.location.href="/";
						});
					}else{
						layer.msg(json_info.msg,{icon:5});
						layui.layer.close(index);
						return false;
					}
				}
			})
		})
	})
</script>
<?php //require .'/weshare.php';//
  require './weshare.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Share Demo</title>
</head>
<body>
</body>
// 步骤6.调用JS接口
<script type="text/JavaScript" src="http://res2.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $ws["appId"]; ?>',
        timestamp: '<?php echo $ws["timestamp"]; ?>',
        nonceStr: '<?php echo $ws["nonceStr"]; ?>',
        signature: '<?php echo $ws["signature"]; ?>',
        jsApiList: [
            'translateVoice',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
        ]
    });


    var wstitle = "我是标题";
    var wsdesc = "我是描述";
    var wslink = "<?php echo $surl; ?>";
    var wsimg = "http://fmwei.com/usr/uploads/2016/07/794257096.png";


    wx.ready(function () {
        // 分享到朋友圈
        wx.onMenuShareTimeline({
            title: wstitle,
            link: wslink,
            imgUrl: wsimg,
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
              
            }
        });

        // 分享给朋友
        wx.onMenuShareAppMessage({
            title: wstitle,
            desc: wsdesc,
            link: wslink,
            imgUrl: wsimg,
            type: wslink,
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
            }
        });

        // 分享到QQ
        wx.onMenuShareQQ({
            title: wstitle,
            desc: wsdesc,
            link: wslink,
            imgUrl: wsimg,
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
            }
        });

        // 微信到腾讯微博
        wx.onMenuShareWeibo({
            title: wstitle,
            desc: wsdesc,
            link: wslink,
            imgUrl: wsimg,
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
            }
        });

        // 分享到QQ空间
        wx.onMenuShareQZone({
            title: wstitle,
            desc: wsdesc,
            link: wslink,
            imgUrl: wsimg,
            success: function () {
                alert('分享成功');
            },
            cancel: function () {
            }
        });

    });

</script>
</html>
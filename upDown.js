/**
 * Created by Vince on 2015/10/7.
 */

var isAuto = true;
var timer = null;
var run = false;

//每次滚动条滚动时触发
window.onscroll = function(){
    if(!isAuto){
        clearInterval(timer);
        run = false;
    }
    //用户滚动滚动条时，使isTop为false并取消定时器，即取消自动滚动
    isAuto = false;
}


function up(){
    if(!run){
        run = true;//避免up、down同时运行
        //设置定时器，每30us执行一次，实现动画效果
        timer = setInterval(function(){
            //获取滚动条距页面顶端距离
            var osTop = document.body.scrollTop;
            //计算每执行一次定时器向上拖动距离，实现越来越慢的效果
            //用负数是因为当osTop小于5时除完的小数向下取整为-1，若为整数向下取整为0，无论怎么减都减不到0
            var speed = Math.floor(-osTop/10);

            document.body.scrollTop = osTop+speed;
            console.log(osTop,speed);
            //自动滚动时也会触发onscroll，避免取消定时器，要滚动时设置isAuto
            isAuto = true;
            //距离减为0时取消定时器
            if(osTop==0){
                clearInterval(timer);
                run = false;
            }
        },30);
    }

}

function down(){
    //由于浏览器兼容性问题
    //滚动条在Y轴上的滚动距离
    function getScrollTop(){
        var scrollTop = 0, bodyScrollTop = 0, documentScrollTop = 0;
        if(document.body){
            bodyScrollTop = document.body.scrollTop;
        }
        if(document.documentElement){
            documentScrollTop = document.documentElement.scrollTop;
        }
        //scrollTop = (bodyScrollTop - documentScrollTop > 0) ? bodyScrollTop : documentScrollTop;
        return bodyScrollTop;
    }
    //文档的总高度
    function getScrollHeight(){
        var scrollHeight = 0, bodyScrollHeight = 0, documentScrollHeight = 0;
        if(document.body){
            bodyScrollHeight = document.body.scrollHeight;
        }
        if(document.documentElement){
            documentScrollHeight = document.documentElement.scrollHeight;
        }
        scrollHeight = (bodyScrollHeight - documentScrollHeight > 0) ? bodyScrollHeight : documentScrollHeight;
        return bodyScrollHeight;
    }
    //浏览器视口的高度
    function getWindowHeight(){
        var windowHeight = 0;
        if(document.compatMode == "CSS1Compat"){
            windowHeight = document.documentElement.clientHeight;
        }else{
            windowHeight = document.body.clientHeight;
        }
        return windowHeight;
    }


    if(!run) {
        run = true;
        //设置定时器，每30us执行一次，实现动画效果
        timer = setInterval(function () {
            //还剩下的滚动条长度
            var osTop = getScrollTop();
            //计算每执行一次定时器向上拖动距离，实现越来越慢的效果
            //用负数是因为当osTop小于5时除完的小数向下取整为-1，若为整数向下取整为0，无论怎么减都减不到0
            var leftscroll = getScrollHeight() - getWindowHeight() - osTop;
            var speed = Math.ceil(leftscroll / 10);

            document.body.scrollTop = osTop + speed;
            console.log(getScrollTop(), getWindowHeight(), getScrollHeight());
            //自动滚动时也会触发onscroll，避免取消定时器，要滚动时设置isAuto
            isAuto = true;
            //判断是否拉到页面底部
            if (getScrollTop() + getWindowHeight() == getScrollHeight()) {
                clearInterval(timer);
                run = false;
            }
        }, 30);
    }

}



/**
 * Created by Vince on 2015/10/7.
 */

var isAuto = true;
var timer = null;
var run = false;

//ÿ�ι���������ʱ����
window.onscroll = function(){
    if(!isAuto){
        clearInterval(timer);
        run = false;
    }
    //�û�����������ʱ��ʹisTopΪfalse��ȡ����ʱ������ȡ���Զ�����
    isAuto = false;
}


function up(){
    if(!run){
        run = true;//����up��downͬʱ����
        //���ö�ʱ����ÿ30usִ��һ�Σ�ʵ�ֶ���Ч��
        timer = setInterval(function(){
            //��ȡ��������ҳ�涥�˾���
            var osTop = document.body.scrollTop;
            //����ÿִ��һ�ζ�ʱ�������϶����룬ʵ��Խ��Խ����Ч��
            //�ø�������Ϊ��osTopС��5ʱ�����С������ȡ��Ϊ-1����Ϊ��������ȡ��Ϊ0��������ô����������0
            var speed = Math.floor(-osTop/10);

            document.body.scrollTop = osTop+speed;
            console.log(osTop,speed);
            //�Զ�����ʱҲ�ᴥ��onscroll������ȡ����ʱ����Ҫ����ʱ����isAuto
            isAuto = true;
            //�����Ϊ0ʱȡ����ʱ��
            if(osTop==0){
                clearInterval(timer);
                run = false;
            }
        },30);
    }

}

function down(){
    //�������������������
    //��������Y���ϵĹ�������
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
    //�ĵ����ܸ߶�
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
    //������ӿڵĸ߶�
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
        //���ö�ʱ����ÿ30usִ��һ�Σ�ʵ�ֶ���Ч��
        timer = setInterval(function () {
            //��ʣ�µĹ���������
            var osTop = getScrollTop();
            //����ÿִ��һ�ζ�ʱ�������϶����룬ʵ��Խ��Խ����Ч��
            //�ø�������Ϊ��osTopС��5ʱ�����С������ȡ��Ϊ-1����Ϊ��������ȡ��Ϊ0��������ô����������0
            var leftscroll = getScrollHeight() - getWindowHeight() - osTop;
            var speed = Math.ceil(leftscroll / 10);

            document.body.scrollTop = osTop + speed;
            console.log(getScrollTop(), getWindowHeight(), getScrollHeight());
            //�Զ�����ʱҲ�ᴥ��onscroll������ȡ����ʱ����Ҫ����ʱ����isAuto
            isAuto = true;
            //�ж��Ƿ�����ҳ��ײ�
            if (getScrollTop() + getWindowHeight() == getScrollHeight()) {
                clearInterval(timer);
                run = false;
            }
        }, 30);
    }

}



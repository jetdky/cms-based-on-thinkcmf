function clickHide(clickElemName, hideElemId, judgeHideVal) {
    //初始化隐藏
    var initVal = $("input[name='" + clickElemName + "']:checked").val();
    if (initVal == judgeHideVal) {
        $("#" + hideElemId).css('display', 'none');
    }
    //点击隐藏和显示
    $("input[name='" + clickElemName + "']").on('click', function () {
        var val = $("input[name='" + clickElemName + "']:checked").val();
        if (val == judgeHideVal) {
            $("#" + hideElemId).fadeOut();
        } else {
            $("#" + hideElemId).fadeIn();
        }
    });
}

function initTags(tagId, url) {
    var data = '';
    $.ajax({
        url: url,
        type: 'post',
        data: {},
        dataType: 'json',
        async: false,
        success: function (res, status, xhr) {
            data = res;
        },
        error: function (res, status, xhr) {

        }
    });
    var tags = xmSelect.render({
        el: tagId,
        prop: {
            value: 'id'
        },
        initValue: data['status'],
        paging: true,
        name: 'tag_id',
        pageSize: 5,
        tips: '无标签',
        filterable: true,
        data: data['data']
    });
}

function writeCurrentDate() {
    var now = new Date();
    var year = now.getFullYear(); //得到年份
    var month = now.getMonth();//得到月份
    var date = now.getDate();//得到日期
    var day = now.getDay();//得到周几
    var hour = now.getHours();//得到小时
    var minu = now.getMinutes();//得到分钟
    var sec = now.getSeconds();//得到秒
    var MS = now.getMilliseconds();//获取毫秒
    var week;
    month = month + 1;
    if (month < 10) month = "0" + month;
    if (date < 10) date = "0" + date;
    if (hour < 10) hour = "0" + hour;
    if (minu < 10) minu = "0" + minu;
    if (sec < 10) sec = "0" + sec;
    if (MS < 100) MS = "0" + MS;
    var arr_week = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
    week = arr_week[day];
    var time = "";
    time = year + "-" + month + "-" + date + "T" + hour + ":" + minu + ":" + sec;
    $("[name='show_time']").val(time);
}

function deleImg(contentId, type) {
    $(document).on("click", "[class='del-img']", function () {
        var imgId = $(this).nextAll("input").attr('data-id');
        imgId ? imgId = imgId : imgId = 0;
        var ajaxContentId = contentId;
        var ajaxType = type;
        var that = this;
        $.ajax({
            url: "/admin/Img/delete",
            type: 'get',
            data: {
                imgId: imgId,
                contentId: ajaxContentId,
                type: ajaxType
            },
            dataType: 'json',
            success: function (res, status, xhr) {
                if (res.code == 0) {
                    $(that).parent().fadeOut(200);
                    setTimeout(function () {
                        $(that).parent().remove();
                    }, 200)
                } else {
                    alert('删除失败，请与网站 管理员联系');
                }
            },
            error: function (res, status, xhr) {
                console.log('ajax图片删除失败');
            }
        });
    });
}
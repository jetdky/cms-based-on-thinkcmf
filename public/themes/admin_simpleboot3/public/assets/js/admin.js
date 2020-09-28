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
            console.log(res)

        },
        error: function (res, status, xhr) {

        }
    });
    var tags = xmSelect.render({
        el: tagId,
        prop: {
            value: 'id',
            name: 'title'
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
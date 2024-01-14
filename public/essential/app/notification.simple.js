function playNotificationBell() {
    var audio = document.querySelector("#topupbell");
    if (audio === null) {
        audio = document.createElement("audio");
        audio.setAttribute("id", "topupbell");
        var source = document.createElement("source");
        source.setAttribute("src", env.root + "/public/assets/notification.mp3");
        audio.appendChild(source);
        document.body.appendChild(audio);
    }
    try {
        audio.play();
    } catch (e) {
        console.error(e);
    }
    audio.addEventListener("ended", function () {
        // $(audio).remove();
    });

}



var scriptUrl = document.currentScript.getAttribute("src");
var urlParams = new URLSearchParams(scriptUrl.split('?')[1]);

$(function () {

    var panel_template = "";

    panel_template += '<div class="noti-list">';
    panel_template += '<div class="content-right">';
    panel_template += '<div class="title">';
    panel_template += '<h3 class="fw_6">__TITLE__</h3>';
    panel_template += '<span class="fw_6 on_surface_color">__CREATED_AT__</span>';
    panel_template += '</div>';
    panel_template += '<div class="desc">';
    panel_template += '<p class="on_surface_color fw_4">__MESSAGE__</p>';
    panel_template += '<i class="dot"></i>';
    panel_template += '</div>';
    panel_template += '</div>';
    panel_template += '</div>';


    var activity_panel_template = "";

    activity_panel_template += '<a class="tf-trading-history" href="#">';
    activity_panel_template += '<div class="inner-left">';
    activity_panel_template += '<div class="content">';
    activity_panel_template += '<h6>__MESSAGE__</h6>';
    activity_panel_template += '<p>__CREATED_AT__</p>';
    activity_panel_template += '</div>';
    activity_panel_template += '</div>';
    activity_panel_template += '</a>';


    var minutos = 5;
    var milissegundos = 3000;
    var n_ids = [];
    var url = urlParams.get("url");
    const nListenner = setInterval(function () {
        new request(url).quite().setMethod("POST").setIntercept(false).execute(function (r) {
            var notifications = r.response.notifications;
            for (const i in notifications) {
                if (Object.hasOwnProperty.call(notifications, i)) {
                    const notification = notifications[i];
                    if (inArray(notification.id, n_ids)) {
                        continue;
                    }
                    n_ids.push(notification.id);
                    var content = panel_template;
                    content = content.replace("__MESSAGE__", notification.message);
                    content = content.replace("__TITLE__", notification.title);
                    content = content.replace("__CREATED_AT__", notification.created_at);

                    var content1 = activity_panel_template;
                    content1 = content1.replace("__MESSAGE__", notification.message);
                    content1 = content1.replace("__TITLE__", notification.title);
                    content1 = content1.replace("__CREATED_AT__", notification.created_at);

                    $("#notification_panel").prepend(content);
                    $("#activity_notification_panel").prepend(content1);

                    var noty = $("#notification_badge");
                    var count = parseInt(noty.attr("data-count")) + 1;
                    noty.html(count);
                    noty.attr("data-count", count);
                    console.log(465);
                    playNotificationBell();
                }
            }


        });

    }, milissegundos);




});

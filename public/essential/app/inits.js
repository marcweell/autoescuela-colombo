/**
 *
 * @author Nelson Flores <nelson.flores@live.com>
 */

"use strict";
var _link_ = {};
var last_url = location.origin + location.pathname + location.search;


window.onbeforeunload = function () {
    //$('body').fadeOut(500);
    loader.on(5000);
}
document.onerror = function (e) {
    //e.preventDefault();
    output.debug.error(e);
}

app.listenner.add("pageInit", function () {

    history.replaceState = function () {
        replaceState.apply(history, arguments);

        window.dispatchEvent(new Event('replacestate'));
        window.dispatchEvent(new Event('locationchange'));
    };

    window.addEventListener('popstate', function (event) {
        window.dispatchEvent(new Event('locationchange'));
    });

    window.addEventListener('locationchange', function () {
        var url = location.origin + location.pathname + location.search;
        if (last_url != url) {
            last_url = url;
            app.check_hash_page();
        }
        //$("#modal-d").modal("hide");
    });



}); //Listenner


app.listenner.add("clickEvents", function () {

    var panelUp = $(".up");
    var panelDown = $(".down");


    if (panelUp.length) {

        $("#btn-popup-up").click(function (e) {

            e.preventDefault();
            e.stopPropagation();
            panelUp.addClass("panel-open");
            $("html").css("overflow", "hidden");

            Pace.on("start", function () {
                $("html").css("overflow", "auto");
            })

        });
        $(".panel_overlay, .clear-panel").on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            panelUp.removeClass("panel-open");
            $("html").css("overflow", "auto");
        });

    }

    if (panelDown.length) {
        $(".btn-popup-down").on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            panelDown.addClass("panel-open");
        });
        $(".clear-panel").on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            panelDown.removeClass("panel-open");
        });
    }



    $(".decimal_num").each(function () {
        if ($(this).hasClass("decimal_number")) {
            return;
        }
        var num = Tool.number_format($(this).html());
        $(this).addClass("decimal_number");
        $(this).html(num);
    });



    function active(element, index) {

        if (element.hasAttribute("data-api-ticket")) {
            return false;
        }

        var elem = document.createElement("a");
        var id = Tool.encode(element.offsetTop + index + Date.now(), 1);
        element.setAttribute("data-api-ticket", id);

        if (element.hasAttribute("data-id")) {
            elem.setAttribute("data-id", element.getAttribute("data-id"));
        }
        if (element.hasAttribute("href")) {
            elem.setAttribute("href", element.getAttribute("href"));
        }
        if (element.hasAttribute("data-payloads")) {
            elem.setAttribute("data-payloads", element.getAttribute("data-payloads"));
        }
        if (element.hasAttribute("data-href")) {
            elem.setAttribute("data-href", element.getAttribute("data-href"));
        }


        element.removeAttribute("data-href");
        element.removeAttribute("data-payloads");
        element.removeAttribute("data-id");

        _link_[id] = elem;

        new Promise(function () {
            setTimeout(() => {
                //wait 100milis
            }, 100);
        });
    }


    var o = document.getElementsByClassName('_link_');
    for (const i in o) {

        if (Object.hasOwnProperty.call(o, i)) {
            var elem = o[i];
            if (elem.hasAttribute("data-api-ticket")) {
                continue;
            }
            var data_href = elem.getAttribute('data-href');
            if (elem.tagName.toString().toLowerCase() == "a" && data_href != elem.href) {
                if (elem.hasAttribute("data-id")) {
                    elem.href = "javascript:void(0)";
                } else {
                    elem.href = data_href;
                }
            }

            active(elem, i);

        }
    }


    var alt = document.getElementsByClassName('_link__alt');
    for (const i in alt) {
        if (Object.hasOwnProperty.call(alt, i)) {
            var elem = alt[i];
            output.debug.log(elem);
            if (elem.hasAttribute("data-api-ticket")) {
                continue;
            }
            var data_href = elem.getAttribute('data-href');
            if (elem.tagName.toString().toLowerCase() == "a" && data_href != elem.href) {
                if (elem.hasAttribute("data-id")) {
                    elem.href = "javascript:void(0)";
                } else {
                    elem.href = data_href;
                }
            }

            active(elem, i);

        }
    }




    $('.back').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        history.back();
    });
    $('.tab-close').click(function () {
        var elem = $(this).parent().find('[data-toggle=tab]');
        var selector = $(elem).attr('href');
        $('#main-tab-list').find('li').find('[data-toggle="tab"]').each(function (index) {
            if (this == elem) {
                return;
            }
            $(this).click();
            /* $(this.href).addClass('active show');*/
            return false;
        });
        $(selector).remove();
        $(elem).parent().remove();
    });

    $(".prompt-before-open").click(function (e) {
        e.preventDefault();
        var that = this;

        confirm_function = function () {
            location.href = that.href;
        };

        Tool.prompt(confirm_function, this.getAttribute("data-title"), this.getAttribute("data-message"));
    });


    $(env.selector.btn_ajax_link).click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var form = new FormData();
        var elem = _link_[this.getAttribute("data-api-ticket")];
        var id = elem.getAttribute("data-id");
        var url = elem.getAttribute("data-href");
        var elem_target = elem.getAttribute('elem-target');
        elem_target = (elem_target !== null) ? elem_target : env.main_content;
        //form.append('ui_selector', elem_target);


        if (elem.hasAttribute("data-payloads")) {
            try {
                var plds = JSON.parse(elem.getAttribute("data-payloads"));

                for (const index in plds) {
                    if (Object.hasOwnProperty.call(plds, index)) {
                        const value = plds[index];
                        form.append(index, value);
                    }
                }

            } catch (error) {
                output.debug.error(error);
            }
        }



        form.append('id', id);

        var that = elem;
        confirm_function = function () {
            if ($(that).hasClass("self-load")) {
                loader.add_btn_loader(that);
                nfclipboard.function.add(function () {
                    loader.remove_btn_loader(that);
                });
                $(that).html(' <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
            }
            if ($(that).hasClass("parent-load")) {
                $(that).find('.chl_loader').each(function () {
                    var that = this;
                    loader.add_btn_loader(that);
                    nfclipboard.function.add(function () {
                        loader.remove_btn_loader(that);
                    });
                    $(that).html(' <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                });
            }

            new request(url)
                .toNext()
                .before(function () {

                    if (
                        ($('body').hasClass('sidebar-enable') && $('body').hasClass('hide-menu')) ||
                        ($("html").attr("data-sidenav-size") == 'full' && $('html').hasClass('sidebar-enable'))
                    ) {
                        $('html').removeClass('sidebar-enable');
                        $('body').removeClass('sidebar-enable');
                        $('body').removeClass('hide-menu');
                        $("#custom-backdrop").remove();
                    }

                })
                .useLoader(!($(that).hasClass("self-load") || $(that).hasClass("parent-load")))
                .setData(form)
                .setHistory(!that.hasAttribute("data-id"))
                .execute(function (r) {
                    nfclipboard.function.run();

                });
        };


        if ($(this).hasClass("prompt")) {
            Tool.prompt(confirm_function, this.getAttribute("data-title"), this.getAttribute("data-message"));
            return;
        }

        confirm_function();

    });

    $(env.selector.btnChanger).click(function (e) {
        if (requesting == true) {
            e.preventDefault();
            return;
        }
        var form = new FormData();
        var id = this.getAttribute("data-id");
        var url = this.getAttribute("data-href");
        var elem_target = this.getAttribute('elem-target');
        elem_target = (elem_target !== null) ? elem_target : env.main_content;
        //form.append('ui_selector', elem_target);
        form.append('id', id);

        confirm_function = function () {
            new request(url)
                .toNext()
                .quite()
                .setData(form)
                .execute();
        };

        if ($(this).hasClass("prompt")) {
            Tool.prompt(confirm_function, this.getAttribute("data-title"), this.getAttribute("data-message"));
            return;
        }
        setTimeout(function () {
            confirm_function();
        }, timeout(100));

    });

    $(env.selector.btn_reload).click(function (e) {
        e.preventDefault();
        try {
            saved_request.execute();
        } catch (error) {
            output.debug.error(error);
        }
    });



    $(".rm-child").click(function () {
        $(this.getAttribute("data-target")).remove();
    });


    $(".rm_dad").click(function () {
        var elem = this;
        var found = false;
        var i = 0;
        while (found == false && i < 10) {
            elem = elem.parentElement;
            if ($(elem).hasClass("im_dad")) {
                found = true;
            }
            i++;
        }
        if (found) $(elem).remove();
    });

    $(".clonehim").click(function () {
        if (cloning == true) {
            return;
        }

        $(this.getAttribute("to")).append(
            $(this.getAttribute("elem-target")).html()
        );

        cloning = true;

        setTimeout(function () {
            cloning = false;
            app.listenner.listen();
        }, 1000);
    });

}); //Listenner

app.listenner.add("submitEvents", function () {

    $(env.selector.form).submit(function (e) {
        e.preventDefault();
        var that = this;
        var form = new FormData(this);

        var url = this.getAttribute('action');
        var elem_target = (typeof this.getAttribute('elem-target') != 'undefined') ? this.getAttribute("elem-target") : env.main_content;
        //form.append('ui_selector', elem_target);

        confirm_function = function () {
            if ($(that).hasClass("self-load")) {
                $(that).find('[type="submit"]').each(function () {
                    var that_ = this;
                    loader.add_btn_loader(that_);
                    nfclipboard.function.add(function () {
                        loader.remove_btn_loader(that_);
                    });
                    $(that_).html(' <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                });
            }

            if ($(that).hasClass("parent-load")) {
                $(that).find('.chl_loader').each(function () {
                    var that_ = this;
                    loader.add_btn_loader(that_);
                    nfclipboard.function.add(function () {
                        loader.remove_btn_loader(that_);
                    });
                    $(that_).html(' <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                });
            }
            new request(url)
                .setData(form)
                .toNext()
                .useLoader(!($(that).hasClass("self-load") || $(that).hasClass("parent-load")))
                .execute(nfclipboard.function.run());
        };


        if ($(this).hasClass("prompt")) {
            Tool.prompt(confirm_function, this.getAttribute("data-title"), this.getAttribute("data-message"));
            return;
        }

        confirm_function();
    });
}); //Listenner

app.listenner.add("changeEvents", function () {
    $(env.selector.self_form).on('change', function (e) {
        e.preventDefault();
        that = this;
        var that = this;
        var form = new FormData();
        form.append(that.getAttribute('data-name'), $(that).val());
        var url = this.getAttribute('data-action');
        var elem_target = (typeof this.getAttribute('elem-target') != 'undefined') ? this.getAttribute("elem-target") : env.main_content;
        //form.append('ui_selector', elem_target);
        confirm_function = function () {

            var r = new request(url)
                .setData(form).toNext();
            if ($(that).hasClass("quite")) {
                r.quite();
            }
            r.execute();

        };


        if ($(this).hasClass("prompt")) {
            Tool.prompt(confirm_function, this.getAttribute("data-title"), this.getAttribute("data-message"));
            return;
        }

        confirm_function();
    });

}); //Listenner

app.listenner.add("ComponentInits", function () {
    try {
        $(".textarea").summernote({

            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
            ]
        });

    } catch (error) {
        output.debug.error(error);
    }





    var colorInputs = document.querySelectorAll('.hex_color');

    colorInputs.forEach(function (elem) {
        var hueb = new Huebee(elem, {
            // options
            setBGColor: true,
            saturations: 2,
        });


    });















    try {
        $(".upload-fa5").fileinput({
            theme: 'fa5',
            uploadUrl: '#',
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showDownload: true,
                showZoom: true,
                showDrag: false,
                showRotate: true,
            },

            showCaption: true,
            showBrowse: true,

            showUploadStats: false,
            showCancel: null,
            showPause: null,
            showClose: false,

            browseOnZoneClick: false,


            hideThumbnailContent: false,
            overwriteInitial: false,
            initialPreviewAsData: true,

            maxFileCount: 20,
            removeFromPreviewOnError: true,
            previewFileIcon: '<i class="fas fa-file"></i>',

            preferIconicPreview: false, // this will force thumbnails to display icons for following file extensions
            previewFileIconSettings: { // configure your icon file extensions
                'doc': '<i class="fas fa-file-word text-primary"></i>',
                'xls': '<i class="fas fa-file-excel text-success"></i>',
                'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
                'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                'zip': '<i class="fas fa-file-archive text-muted"></i>',
                'htm': '<i class="fas fa-file-code text-info"></i>',
                'txt': '<i class="fas fa-file-alt text-info"></i>',
                'mov': '<i class="fas fa-file-video text-warning"></i>',
                'mp3': '<i class="fas fa-file-audio text-warning"></i>',
                // note for these file types below no extension determination logic
                // has been configured (the keys itself will be used as extensions)
                'jpg': '<i class="fas fa-file-image text-danger"></i>',
                'gif': '<i class="fas fa-file-image text-muted"></i>',
                'png': '<i class="fas fa-file-image text-primary"></i>'
            },
            previewFileExtSettings: { // configure the logic for determining icon file extensions
                'doc': function (ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function (ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function (ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function (ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function (ext) {
                    return ext.match(/(htm|html)$/i);
                },
                'jpg': function (ext) {
                    return ext.match(/(jpg|jpeg)$/i);
                },
                'txt': function (ext) {
                    return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                },
                'mov': function (ext) {
                    return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                },
                'mp3': function (ext) {
                    return ext.match(/(mp3|wav|wma)$/i);
                }
            },

        });
    } catch (error) {
        output.debug.error(error);
    }

    try {
        var quill = new Quill("#snow-editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        script: "super"
                    }, {
                        script: "sub"
                    }],
                    [{
                        header: [!1, 1, 2, 3, 4, 5, 6]
                    }, "blockquote", "code-block"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }, {
                        indent: "-1"
                    }, {
                        indent: "+1"
                    }],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            }
        });
    } catch (error) {
        output.debug.error(error);
    }


    try {
        $(".textareaI").summernote({

            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["insert", ["link", "picture"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
            ],

            callbacks: {
                onImageUpload: function (image) {
                    editor = $(this);
                    this.upload(image[0], editor);
                },
            },

            img_src: env.origin + 'summernote/image',

            upload: function (image, editor) {
                var form = new FormData();
                form.append("image", image);
                new request(this.img_src).execute(
                    function (r) {
                        var image = $("<img>").attr("src", r);
                        $(editor).summernote("insertNode", image[0]);
                    }
                );
            }
        });

    } catch (error) {
        output.debug.error(error);
    }


    /*

    */
    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            $("#modal-d").modal("hide");
            $("#modal-d-body").html('');
        }
    });

    try {
        $(".table_").DataTable({
            //dom: "Bfrtip",
            //buttons: ["pdf"],
            bDestroy: true,
            paging: true,
            deferRender: true,
            orderClasses: true,
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            iDisplayLength: 10,
            //responsive: true,
            language: env.language._datatable_,
        });
    } catch (error) {
        output.debug.error(error);
    }


    try {

        var sourced_tables = document.getElementsByClassName("table_auto");
        for (let i = 0; i < sourced_tables.length; i++) {
            const table = sourced_tables[i];


            if ($(table).hasClass("source_initialized")) {
                continue;
            }

            $(table).addClass("source_initialized");

            var columns = table.hasAttribute("data-cols") ? JSON.parse(table.getAttribute("data-cols")) : [];
            var payload = table.hasAttribute("data-payloads") ? table.getAttribute("data-payloads") : {};
            var url = table.hasAttribute("data-url") ? table.getAttribute("data-url") : '#';
            var method = table.hasAttribute("data-method") ? table.getAttribute("data-method") : "GET";


            $(table).removeAttr("data-cols");
            $(table).removeAttr("data-payloads");
            $(table).removeAttr("data-url");
            $(table).removeAttr("data-key");
            $(table).removeAttr("data-method");


            var counter = 0;
            var cols = [];
            for (const key in columns) {

                cols.push({
                    data: columns[key],
                });

            }

            $(table).DataTable({
                bDestroy: true,
                orderClasses: false,
                deferRender: true,
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: true,
                iDisplayLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"],
                ],
                language: env.language._datatable_,
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                    dataType: "json",
                    type: method,
                    data: payload,
                    error: function (xhr, status, error) { },
                },
                columns: cols,
                drawCallback: function (settings) {
                    app.listenner.listen("clickEvents");
                    var row = settings._iDisplayStart + 1;
                    table.querySelectorAll(".__tbl_row_num__").forEach(function (e) {
                        $(e).html(String(row).padStart(2, '0'));
                        row++
                    });
                },
            });
        }


    } catch (error) {
        output.debug.error(error);
    }

    try {
        $(".m_datatable").DataTable({
            /*dom: "Bfrtip",
            buttons: ["pdf"],*/
            bDestroy: true,
            orderClasses: false,
            deferRender: true,
            paging: true,
            lengthChange: false,
            searching: true,
            ordering: false,
            info: false,
            autoWidth: true,
            iDisplayLength: 10,
            language: env.language._datatable_,
        });
    } catch (error) {
        output.debug.error(error);
    }


    function initSelect2(selector, options = {}, force = false) {
        $(selector).each(function () {
            var _this = this;
            if ($(_this).hasClass("select2-hidden-accessible") && force == false) {
                return;
            }
            if ($(_this).hasClass("select2-hidden-accessible")) {
                $(_this).select2("destroy");
            }
            setTimeout(function () {
                $(_this).select2(options);
            }, 50);
        });
    }

    try {
        initSelect2(".select_init", {
            dropdownParent: null
        });
        initSelect2(".select2tag", {
            dropdownParent: null,
            tags: true
        });
        initSelect2(".select2", {
            dropdownParent: null
        });
        initSelect2('.select2rmt', {
            ajax: {
                url: 'http://localhost/gestao_geral/api/company',
                data: function (params) {
                    var query = {
                        search: {
                            value: params.term
                        },
                        type: 'public',
                        length: 50,
                    }
                    return query;
                },
                processResults: function (data) {
                    return {

                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.id,
                            }
                        })
                    };
                }
            }
        }, true);

    } catch (error) {
        output.debug.error(error);
    }

    env.language._datatable_ = {
        "oAria": {
            "sSortAscending": "Ordenar colunas de forma ascendente",
            "sSortDescending": "Ordenar colunas de forma descendente"
        },
        "oPaginate": {
            "sFirst": "Primeiro",
            "sLast": "Último",
            "sNext": "Próximo",
            "sPrevious": "Anterior"
        },
        "sEmptyTable": "Nenhum registo encontrado",
        "sInfo": "_START_ - _END_ / _TOTAL_",
        "sInfoEmpty": "0 - 0 / 0",
        "sInfoFiltered": "(Filtrados de _MAX_ registos)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ Resultados/Pág.",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sSearch": "Pesquisar",
        "sZeroRecords": "Nenhum registo encontrado",
        "select": {
            "rows": {
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha",
                "_": "Selecionado %d linhas"
            }
        }
    };






    return this;
}); //Listenner

$(function () {
    setTimeout(function () {
        loader.off();
    }, 2000);
})

var forms = document.getElementsByClassName("form_"),
    confirm_function, cloning = false;


for (var i = 0; i < forms.length; i++) {
    const frm = forms[i];
    frm.setAttribute('method', 'POST');
    frm.onsubmit = function (e) {
        e.preventDefault;
        app.listenner.listen();
        return false;
    }

}
window.onload = function () {
    $('body').fadeIn(500);
}

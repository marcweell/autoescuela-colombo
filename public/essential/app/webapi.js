/**
 *
 * @author Nelson Flores <nelson.flores@live.com>
 */

"use strict";

const timeout = function (milisecond = 300) {
    return milisecond;
};



const appName = document.title;

var saved_request,
    requesting = false,

    env = {
        url: window.location.origin + window.location.pathname,
        root: window.location.origin,
        page_title: appName,
        user_id: "-1",
        debug: {
            verbose: false,
            g_verbose: false,
            set: function (bool = false) {
                this.verbose = bool;
                this.g_verbose = bool;
            },
            show: {
                logs: function () {
                    env.debug.logs.forEach(function (val) {
                        for (const index in val) {
                            if (Object.hasOwnProperty.call(val, index)) {
                                const value = val[index];
                                if (console && console[index]) {
                                    console[index](value);
                                }
                            }
                        }
                    });
                }
            },
            logs: []
        },
        token: null,
        language: {
            error: {
                404: "Conte&uacute;do N&atilde;o Encontrado!",
                500: "Erro Interno!",
                501: "Erro Interno!",
                401: "Sem Permissao!",
                0: "Sem Conexao com servidor!"
            },
        },
        selector: {
            main_container: "#page-content",
            form: ".form_",
            btn_ajax_link: "._link_",
            self_form: ".self-form",
            btnChanger: ".switch-link",
            btn_reload: ".reload",
        },
        init: [],
    };

/**
 * Loader Object
 */
const loader = {
    on: function (time = 20000) {
        $("#ftco-loader").addClass("show");
        $(".preload").removeClass("d-none");
        setTimeout(function () {
            loader.off();
        }, timeout(time));
    },
    off: function () {
        try {
            $("#ftco-loader").removeClass("show");
        } catch (error) {
            output.debug.error(error);
        }
        try {
            $(".preload").addClass("d-none");

        } catch (error) {
            output.debug.error(error);
        }
    },
    add_btn_loader: function (btn) {
        if (!btn.hasAttribute("data-value")) {
            btn.setAttribute("data-value", $(btn).html());
        }
        if (!btn.hasAttribute("disabled") || !$(btn).hasClass("disabled")) {
            btn.setAttribute("data-elem-status", "enabled");
            btn.setAttribute("disabled", "disabled");
        }
        return btn;
    },
    remove_btn_loader: function (btn) {
        setTimeout(function () {
            $(btn).html(btn.getAttribute("data-value"));
            if (btn.getAttribute("data-elem-status") == "enabled") {
                $(btn).removeAttr("disabled");
                $(btn).removeAttr("data-elem-status");
            }
        }, 1000);
        return btn;
    },
};

/**
 * Output Handler Object
 */
const output = {
    tables: 0,
    setTitle: function () {},


    container: function (response, elem = env.selector.main_container) {

        var elem = elem;
        var response = response;
        var title = title;
        return new Promise(function () {
            $(elem).fadeOut(300, function () {
                $(this).html(response).fadeIn(400);
            });
        });
    },
    append: function (response, elem = env.selector.main_container) {
        var elem = elem;
        var response = response;
        return new Promise(function () {
            $(elem).append(response);
        });
    },
    modal: function (response) {
        var response = response;
        return new Promise(function () {
            $("#modal-d-body").html(response);
            $("#modal-d").modal("show");
        }).finally(function () {});
    },
    modal_sm: function (response) {
        var response = response;
        return new Promise(function () {
            $("#modal-d-sm-body").html(response);
            $("#modal-d-sm").modal("show");
        }).finally(function () {});
    },
    notify: function (response, lifetime = 5000) {
        var response = response;
        return new Promise(function () {
            try {
                $.toast({
                    //text: response,
                    heading: response,
                    showHideTransition: 'fade',
                    allowToastClose: true,
                    hideAfter: lifetime,
                    stack: 100,
                    position: 'top-center',
                    bgColor: '#444444',
                    textColor: '#eeeeee',
                    textAlign: 'left',
                    loader: true,
                    loaderBg: '#8c5bb5',
                });
            } catch (error) {
                output.debug.error(error);
            }
        });
    },
    alert: function (response, lifetime = 5000) {
        var response = response;
        return new Promise(function () {
            try {
                $.toast({
                    //text: response,
                    heading: response,
                    showHideTransition: 'fade',
                    allowToastClose: true,
                    hideAfter: lifetime,
                    stack: 100,
                    position: 'top-center',
                    bgColor: '#EA5455',
                    textColor: '#eeeeee',
                    textAlign: 'left',
                    loader: true,
                    loaderBg: '#8c5bb5',
                });

            } catch (error) {
                output.debug.error(error);
            }
        });
    },
    debug: {
        error: function (e, force = false) {
            if (env.debug.verbose == true || force == true) {
                console.error(e);
                if (env.debug.g_verbose == true) {
                    output.alert(e, 50000);
                }
            }
            env.debug.logs.push({
                error: e
            });
        },
        log: function (e, force = false) {
            if (env.debug.verbose == true || force == true) {
                console.log(e);
            }

            env.debug.logs.push({
                info: e
            });
        },
        debug: function (e, force = false) {
            if (env.debug.verbose == true || force == true) {
                console.debug(e);
            }
            env.debug.logs.push({
                debug: e
            });
        },
        warn: function (e, force = false) {
            if (env.debug.verbose == true || force == true) {
                console.warn(e);
            }
            env.debug.logs.push({
                warn: e
            });
        },
        trace: function (e, force = false) {
            if (env.debug.verbose == true || force == true) {
                console.trace(e);
            }
            env.debug.logs.push({
                trace: e
            });
        },
    }
};

/**
 * Framework Object
 */
const Tool = {
    number_format(number, decimals = 2, dec_point = ",", thousands_sep = " ") {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    },
    trim: function (charr, str) {
        str = str.trim();
        while (str.startsWith(charr)) {
            str = Tool.substr(str, 1, str.length);
        }
        while (str.endsWith(charr)) {
            str = Tool.substr(str, 0, str.length - charr.length);
        }
        return str;
    },
    space: function (str, s = 3, char = " ") {
        var arr = [];
        var c = 0;
        while (Tool.count(str) > s) {
            arr[c] = Tool.substr(str, 0, s) + char;
            str = Tool.substr(str, s);
            c++;
        }

        arr[c] = str;
        c++;
        str = "";
        for (var i = 0; i < arr.length; i++) {
            str += arr[i];
        }

        return str;
    },
    split: function (limiter = ".", str) {
        return str.toString().split(limiter);
    },
    shuffle: function (array) {
        var currentIndex = array.length,
            randomIndex;

        while (currentIndex != 0) {

            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex--;

            [array[currentIndex], array[randomIndex]] = [
                array[randomIndex], array[currentIndex]
            ];
        }

        return array;
    },
    count: function (arr = []) {
        if (typeof str == "number") {
            str = str.toString();
        }
        return arr.length;
    },
    substr: function (str, start = 0, end) {
        end = end !== null ? end : str.length;
        return str.toString().substring(start, end);
    },
    decode: function (str, c = 5) {
        for (var i = 0; i < c; i++) {
            if (i == 0) {
                str = atob(str);
            }
            var arr = [];
            arr = Tool.trim(".", str);
            if (Tool.count(arr) > 0) {
                str = "";
                for (var index = Tool.count(arr) - 1; index >= 0; index--) {
                    str += arr[index];
                    if (index > 0) {
                        /*str += '.';*/
                    }
                }
            }
            str = atob(str);
        }

        return str;
    },
    encode: function (str, loops = 5) {

        for (var i = 0; i < loops; ++i) {
            str = btoa(str);
            str = str.replace("=", "");
            str = Tool.space(str, 30, ".");
            var arr = [];
            arr = Tool.trim(".", str);
            if (Tool.count(arr) > 0) {
                str = "";
                for (var index = Tool.count(arr) - 1; index >= 0; --index) {
                    str += arr[index];
                    if (index > 0) {
                        str += ".";
                    }
                }
            }
            if (i == loops - 1) {
                str = btoa(str);
            }
            str = str.replace("=", "");
        }

        return str.toString().replace("=", "");;
    },
    input_to_base64: async function (file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        return await new Promise(function (resolve, reject) {
            reader.onload = function () {
                resolve(reader.result);
            };
            reader.onerror = function (error) {
                resolve("");
            };
        })
    },
    prompt_shown: false,
    prompt: function (handle = function () {}, title = document.title, message = null) {
        if (this.prompt_shown == true) {
            return;
        }
        var pp = this;
        pp.prompt_shown = true;
        try {
            return $.confirm({
                title: title,
                content: (message !== null && typeof message !== "undefined") ? message : "Tem certeza que deseja efectuar esta opera&ccedil;&atilde;o?",
                buttons: {
                    "Sim": function () {
                        handle();
                        pp.prompt_shown = false;
                    },
                    "Cancelar": function () {
                        pp.prompt_shown = false;
                    },
                }
            });
        } catch (error) {
            output.debug.error(error);
            pp.prompt_shown = false;
        }
    },
    isObject: function (item) {
        return (item && typeof item === 'object' && !Array.isArray(item));
    },

    /**
     * Deep merge two objects.
     * @param target
     * @param ...sources
     */
    mergeObj: function (target, ...sources) {
        if (!sources.length) return target;
        const source = sources.shift();

        if (this.isObject(target) && this.isObject(source)) {
            for (const key in source) {
                if (this.isObject(source[key])) {
                    if (!target[key]) Object.assign(target, {
                        [key]: {}
                    });
                    this.mergeObj(target[key], source[key]);
                } else {
                    Object.assign(target, {
                        [key]: source[key]
                    });
                }
            }
        }

        return this.mergeObj(target, ...sources);
    }
};

const nfclipboard = {
    function: {
        data: [],
        run: function () {
            for (var i = 0; i < this.data.length; i++) {
                this.data[i]();
            }
        },
        add: function (fn) {
            this.data.push(fn);
        },
    },
    history: {
        data: [],
        is_last: function (url) {
            for (var i = this.data.length; i >= 0; i--) {
                if (this.data[i] == url) {
                    return true;
                } else {
                    return false;
                }
                break;
            }
        },
        add: function (url) {
            if (this.is_last(url)) {
                return false;
            }
            this.data.push(url);
            if (location.href !== url) {
                window.history.pushState({}, document.title, url);
                var url = location.origin + location.pathname + location.search;
                last_url = url;
            }


        },
    },
    intent: {
        is_same: function (r1, r2) {
            for (const i in r1) {
                var result = true;
                if (typeof r1[i] == "object") {
                    result = this.is_same(r1[i], r2[i]);
                } else {
                    result = r1[i] == r2[i];
                }
                if (result == false) {
                    return false;
                }
            }
            return true;
        },
        make: function (request_) {
            var frm = {};
            for (var [i, value] of request_.request_data.entries()) {
                frm[i] = value;
            }
            var r = {
                url: request_.url,
                ui_selector: request_.method,
                method: request_.ui_selector,
                intercept: request_.intercept,
                rNext: request_.rNext,
                listen: request_.listen,
                request_data: frm,
            };
            return r;
        },
        fired: false,
        data: [],
        run: function (request_ = null) {
            var that = this;
            var ln = this.data.length;
            var b = this.make(request_);
            for (var i = 0; i < ln; i++) {
                var r = this.data[i];
                if (request_ !== null) {
                    var a = this.make(r);
                    if (JSON.stringify(b) === JSON.stringify(a)) {
                        if (this.fired == true) {
                            return true;
                        }
                        that.fired = true;
                        r.next().then(function (t) {
                            setTimeout(function () {
                                app.listenner.listen();
                            }, timeout(t));
                        });
                        setTimeout(function () {
                            that.fired = false;
                        }, timeout(500));
                        return true;
                    } else {
                        continue;
                    }
                }
                setTimeout(() => {
                    r.next().then(function (t) {
                        setTimeout(function () {
                            app.listenner.listen();
                        }, timeout(t));
                    });
                }, timeout(500) * (1 + i));
            }
            if (request_ == null) {
                return true;
            } else {
                return false;
            }
        },
        add: function (request_) {
            var ln = this.data.length;
            var b = this.make(request_);
            for (var i = 0; i < ln; i++) {
                var r = this.data[i];
                var a = this.make(r);
                if (JSON.stringify(b) === JSON.stringify(a)) {
                    return true;
                }
            }
            this.data.push(request_);
            return true;
        },
    },
    clear: {
        data: function (that = nfclipboard) {
            that.intent.data = [];
            return that;
        },
        intent: function (that = nfclipboard) {
            that.function.data = [];
            return that;
        },
        function: function (that = nfclipboard) {
            that.history.data = [];
            return that;
        },
        all: function (that = nfclipboard) {
            return that.clear.data().clear.intent().clear.function();
        },
    },
};

const app = {
    initilized: false,
    new: function (app = null) {
        var apps = {
            request: function (url = location.href) {
                return new request(url);
            },
            output: output,
        };

        if (app !== null) {
            return apps[app];
        } else {
            return apps;
        }
    },
    check_status: null,
    status_init: function (url = null) {
        var uri = url;
        var timeou = 3 * 60000;

        function status() {
            new request(uri)
                .quite()
                .setData(new FormData())
                .paralel()
                .execute();
        }
        setTimeout(function () {
            this.check_status = setInterval(status(), timeou);
        }, 1000);
        return this;
    },
    status_cancel: function () {
        clearInterval(this.check_status);
        return this;
    },

    listenner: {
        listenning: false,
        data: [],
        add: function (index = null, fn) {
            if (index === null) {
                index = "ROOT";
            }
            if (!this.data[index]) {
                this.data[index] = [];
            }
            this.data[index].push(fn);
        },
        run: function (index = null, handle) {
            var listenner = this;

            if (index !== null) {
                const arr = listenner.data[index];
                arr.forEach(function (listen) {
                    listen();
                });
                handle();
                return listenner;
            }

            for (const i in listenner.data) {
                if (Object.hasOwnProperty.call(listenner.data, i)) {
                    const arr = listenner.data[i];
                    arr.forEach(function (listen) {
                        listen();
                    });
                }
            }

            handle();
            return listenner;
        },
        listen: function (index = null, force = false) {
            const listenner = this;
            if (listenner.listenning == true && force == false) {
                return listenner;
            }

            this.run(index, function () {
                listenner.listenning = false;
            });

            return this;
        },
    },
    check_hash_page() {
        new request(location.href).setData(new FormData()).toNext().execute();
    },
    reinit: function () {
        this.init(env);
    },
    init: function (options = {}) {
        for (const index in env) {
            if (index == "debug") {
                continue;
            }
            if (options.hasOwnProperty(index)) {
                env[index] = options[index];
            }
        }

        if (options.hasOwnProperty("debug")) {
            env.debug.verbose = options.debug;
        }

        last_url = env.root;

        for (const i in env.init) {
            new request(env.init[i].url)
                .toNext()
                .setDelay(500)
                .paralel()
                .setData(new FormData())
                .execute();
        }

        setTimeout(function () {
            app.listenner.listen();
        }, 500);


        return this;
    },
    minify_url: function (url) {
        var url = url.substring(url.indexOf("/"));
        var env_origin = env.root.substring(env.root.indexOf("/"));

        if (url.startsWith(env_origin)) {
            url = url.substring(env_origin.length, url.length);
        }

        url = Tool.trim(url, "/");
        return url;
    },
};


/**
 * Request Manager
 *
 * contentType: application/json | text/html | false
 */
class request {
    constructor(url = location.href) {
        this.ui_selector = env.selector.main_container;
        this.start_loader = true;
        this.intercept = true;
        this.listen = true;
        this.history = false;
        this.rNext = false;
        this.callback_timeout = 500;
        this.contentType = "application/json";
        this.url = window.location.href;
        this.response = null;
        this.ajax = null;
        this.method = "POST";
        this.request_data = new FormData();
        this.url = url;
        this.debug = true;
        this.success = false;
        this.before_function = function () {};
    }
    abort() {}
    setUrl(url) {
        var protocol = window.location.protocol;
        if (url.startsWith("//")) {
            url = protocol + url;
        } else if (url.startsWith("/")) {
            url = env.url + url;
        }
        this.url = url;
        return this;
    }

    setMethod(method = "POST") {
        this.method = method;
        return this;
    }
    setIntercept(it = false) {
        this.intercept = it;
        return this;
    }

    setListen(it = false) {
        this.listen = it;
        return this;
    }

    setHistory(it = false) {
        this.history = it;
        return this;
    }

    setData(data) {
        this.request_data = data;
        return this;
    }
    setDelay(milisecond = 0) {
        this.delay = milisecond;
        return this;
    }

    ui(selector = env.selector.main_container) {
        this.selector = selector;
        return this;
    }

    quite() {
        this.start_loader = false;
        return this;
    }
    useLoader(set = true) {
        this.start_loader = set;
        return this;
    }

    paralel() {
        this.intercept = false;
        return this;
    }


    before(fn) {
        this.before_function = fn;
        return this;
    }

    toNext() {
        this.rNext = true;
        return this;
    }

    async process_intent(intent, request = this) {
        if (!intent.hasOwnProperty("type")) {
            return;
        }
        if (!intent.hasOwnProperty("timeout")) {
            return;
        }

        var func = function () {};
        switch (intent.type.toLowerCase()) {
            case "notify":
                var content = !intent.hasOwnProperty("content") ? "" : intent.content;
                var lifetime = !intent.hasOwnProperty("lifetime") ?
                    5000 :
                    intent.lifetime;
                func = function () {
                    output.notify(content, lifetime);
                };
                break;
            case "notifyli":
                var content = !intent.hasOwnProperty("content") ? "" : intent.content;
                var lifetime = !intent.hasOwnProperty("lifetime") ?
                    5000 :
                    intent.lifetime;
                func = function () {
                    try {
                        var json = content;
                        var ul = document.createElement("ul");
                        for (var i = 0; i < json.length; i++) {
                            const element = json[i];
                            var li = document.createElement("li");
                            li.innerHTML = element;
                            ul.appendChild(li);
                        }
                        output.notify(ul.outerHTML, lifetime);
                    } catch (error) {
                        output.debug.error(error);
                    }
                };
                break;
            case "alertli":
                var content = !intent.hasOwnProperty("content") ? "" : intent.content;
                var lifetime = !intent.hasOwnProperty("lifetime") ?
                    5000 :
                    intent.lifetime;
                func = function () {
                    try {
                        var json = content;
                        var ul = document.createElement("ul");
                        for (var i = 0; i < json.length; i++) {
                            const element = json[i];
                            var li = document.createElement("li");
                            li.innerHTML = element;
                            ul.appendChild(li);
                        }
                        output.alert(ul.outerHTML, lifetime);
                    } catch (error) {
                        output.debug.error(error);
                    }
                };
                break;
            case "alert":
                var content = !intent.hasOwnProperty("content") ? "" : intent.content;
                var lifetime = !intent.hasOwnProperty("lifetime") ?
                    5000 :
                    intent.lifetime;
                func = function () {
                    output.alert(content, lifetime);
                };
                break;
            case "print":
                var content = !intent.hasOwnProperty("content") ? "__NOTHING_TO_SHOW__" : intent.content;
                var to = !intent.hasOwnProperty("to") ? "document" : intent.to;
                var selector = !intent.hasOwnProperty("selector") ? request.ui_selector : intent.selector;
                func = function () {
                    switch (to) {
                        case "modal":
                            output.modal(content);

                            break;
                        case "modal-sm":
                            output.modal_sm(content);

                            break;
                        default:

                            output.container(content, selector);
                            var mo = document.querySelector(selector);
                            $("html, body").animate({
                                    scrollTop: mo.offsetTop - 300,
                                },
                                200
                            );

                            break;
                    }

                };
                break;
            case "append":
                var content = !intent.hasOwnProperty("content") ? "__NOTHING_TO_SHOW__" : intent.content;
                var to = !intent.hasOwnProperty("to") ? "document" : intent.to;
                var selector = !intent.hasOwnProperty("selector") ?
                    request.ui_selector :
                    intent.selector;
                func = function () {
                    output.append(content, selector);
                };
                break;
            case "try":
                var that = request;
                var payload = !intent.hasOwnProperty("payload") ? [] : intent.payload;
                var process = !intent.hasOwnProperty("process") ? true : intent.process;
                var url = !intent.hasOwnProperty("url") ? null : intent.url;

                var data = new FormData();
                for (var i in payload) {
                    data.append(i, payload[i]);
                }
                var r = that.setUrl(url).setData(data).paralel();
                if (process == true) {
                    r.toNext();
                }

                func = function () {
                    if (url !== null) {
                        r.execute();
                    }
                };
                break;
                case "set":
                    func = function () {
                        var name = intent.name;
                        var selector = intent.selector;
                        var content = intent.content;
                        $(selector).attr(name, content);
                    };

                    break;
                    case "inner":
                        func = function () {
                            var selector = intent.selector;
                            var content = intent.content;
                            $(selector).html(content);
                        };

                        break;
            case "download":
                func = function () {
                    var name = intent.name;
                    var url = intent.url;
                    var a = document.createElement("a");
                    a.href = url;
                    a.target = "_BLANK";
                    a.download = name;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };

                break;
            case "process_table":
                func = function () {
                    var selector = !intent.hasOwnProperty("selector") ?
                        null :
                        intent.selector;
                    var columns = !intent.hasOwnProperty("columns") ? [] : intent.columns;
                    var payload = !intent.hasOwnProperty("payload") ? [] : intent.payload;
                    var url = !intent.hasOwnProperty("url") ? null : intent.url;

                    var cols = [];
                    for (const key in columns) {
                        cols.push({
                            data: columns[key],
                            name: columns[key],
                        });
                    }
                    var protocol = window.location.protocol;

                    if (url.startsWith("//")) {
                        url = protocol + url;
                    }
                    if (selector === null) {
                        return;
                    }

                    $(selector).DataTable({
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
                            type: "POST",
                            data: payload,
                            error: function (xhr, status, error) {
                                var errorMessage =
                                    xhr.status +
                                    ": " +
                                    (typeof env.language.error[xhr.status] == "undefined" ?
                                        error :
                                        env.language.error[xhr.status]);
                                if (that.rNext == true) {
                                    output.alert(errorMessage);
                                }
                                loader.off();
                                that.response = errorMessage;
                            },
                        },
                        columns: cols,
                        drawCallback: function (settings) {
                            setTimeout(function () {
                                app.listenner.listen();
                            }, 300);
                        },
                    });
                };

                break;
            case "execute":
                var command = !intent.hasOwnProperty("command") ? "" : intent.command;
                switch (command) {
                    case "redirect":
                        func = function () {
                            $("body").fadeOut(250, function () {
                                if (intent.hasOwnProperty("redirect_url")) {
                                    location.href = intent.redirect_url;
                                } else {
                                    window.location.reload();
                                }
                            });
                        };
                        break;
                    case "reload":
                        func = function () {
                            $("body").fadeOut(250, function () {
                                window.location.href = window.location.origin + window.location.pathname;
                            });
                        };
                        break;
                    case "refresh":
                        func = function () {
                            window.location.reload();
                        };
                        break;
                    case "resync":
                        func = function () {
                            try {
                                var r = saved_request.setIntercept();
                                r.execute();
                            } catch (error) {
                                output.debug.error(error);
                            }
                        };
                        break;
                    case "save":
                        func = function () {
                            try {
                                saved_request = request;
                            } catch (error) {
                                output.debug.error(error);
                            }
                        };
                        break;
                    case "cache":
                        func = function () {
                            try {
                                nfclipboard.intent.add(request);
                            } catch (error) {
                                output.debug.error(error);
                            }
                        };
                        break;
                    case "listen":
                        func = function () {
                            try {
                                app.listenner.listen();
                            } catch (error) {
                                output.debug.error(error);
                            }
                        };
                        break;
                    case "hide_dialog":
                        func = function () {
                            $("#modal-d").modal("hide");
                            $("#modal-d-body").html("");
                            $("#modal-d-sm").modal("hide");
                            $("#modal-d-sm-body").html("");
                        };
                        break;
                    case "clean_url":
                        nfclipboard.history.add(
                            window.location.origin + window.location.pathname
                        );
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }

        if (intent.async == true) {
            new Promise(function () {
                setTimeout(function () {
                    func();
                }, intent.timeout);
            });
        } else {
            await new Promise(function () {
                setTimeout(function () {
                    func();
                }, intent.timeout);
            });
        }

        return;
    }

    async next(callback = null) {
        var that = this;
        that.success = false;

        var response;
        try {
            response = this.response;
        } catch (error) {
            output.debug.error(error);
            return this.callback_timeout;
        }

        if (!response.hasOwnProperty("data")) {
            return this.callback_timeout;

        }



        var go_intent = true;
        if (response.hasOwnProperty("require")) {
            go_intent = false;
            var count = 0;

            await response.require.forEach(async function (component) {
                await new Promise(function (resolve) {
                    var elem;
                    var uri = env.root + "/require?url=" + component.url + "&token=" + component.token + "&content-type=" + component['content-type'];
                    component.url = uri;

                    if (component['content-type'] == 'application/javascript') {
                        elem = document.createElement('script');
                        elem.src = component.url;
                    } else if (component['content-type'] == 'text/css') {
                        elem = document.createElement('link');
                        elem.rel = "stylesheet";
                        elem.type = "text/css";
                        elem.href = component.url;
                    }


                    var ajax = true;
                    if (!document.head.innerHTML.includes(elem.outerHTML) || (document.head.innerHTML.includes(elem.outerHTML) && component.force == true)) {
                        document.head.appendChild(elem);
                    } else {
                        ajax = false;
                        count++;
                        if (response.require.length >= count) {
                            go_intent = true;
                        }
                        return;
                    }



                    $.ajax({
                        url: uri,
                        type: "GET",
                        processData: false,
                        contentType: "application/json",
                        cache: false,
                    }).done(function (e) {
                        count++;
                        if (response.require.length >= count) {
                            go_intent = true;
                        }
                        resolve(true);
                    });

                });
            })
            if (response.require.length == 0) {
                go_intent = true;
            }
        }



        if (!response.data.hasOwnProperty("intent")) {
            return this.callback_timeout;
        }

        var intent_interval = await setInterval(async function () {
            if (go_intent == false) {
                return;
            }

            await response.data.intent.forEach(async function (intent) {
                intent.timeout = !intent.hasOwnProperty("timeout") ? 0 : intent.timeout;
                intent.async = !intent.hasOwnProperty("async") ? false : intent.async;
                if (intent.async == false) {
                    that.callback_timeout += intent.timeout;
                }
                await that.process_intent(intent);
            });
            clearInterval(intent_interval);
        }, 200);

        if (response.data.hasOwnProperty("title")) {
            setTimeout(function () {
                if (response.data.title !== null && response.data.title !== "") {
                    document.title = appName + "|" + response.data.title;
                    $(".page-content-title").html(response.data.title);
                }
            }, 100);
        }


        if (callback != null) {
            setTimeout(function () {
                callback(that.response);
            }, timeout(that.callback_timeout));
        }
        return that.callback_timeout;
    }

    async execute(then = null) {
        var that = this;
        app.initilized = true;

        if (requesting == true && that.intercept == true) {
            return that;
        }

        if (that.intercept == true) {
            requesting = true;
        }

        setTimeout(function () {
            requesting = false;
        }, 200);

        if (nfclipboard.intent.run(that) == true) {
            if (then != null) {
                then(that);
            }
            return that;
        }

        var payload = null;


        switch (that.contentType) {

            case "application/json":

                var json = {}

                var js = {};

                var size = []; //company array sizes


                for (var [key, value] of that.request_data.entries()) {

                    if (typeof value === "object") {
                        var file = value;
                        value = {};
                        value.file = await Tool.input_to_base64(file);
                        value.filename = file.name;
                    }
                    if (key.endsWith("]")) {
                        var name = key;

                        var arr = name.split("[");
                        arr = arr.reverse();

                        var last_index = null;
                        var last_object = {};
                        var last_unique = "";


                        arr.forEach(function (val, i) {

                            var index = val;

                            if (index.toString().endsWith("]") == true) {
                                index = index.substring(0, index.length - 1);
                            }

                            var unique = index;
                            if (last_index !== null) {
                                unique = last_unique + "." + unique;
                            }

                            if (index === "") {
                                if (!size[unique]) {
                                    size[unique] = 0;
                                }
                                index = size[unique];
                                size[unique]++;
                            }

                            if (last_index !== null) {
                                value = {};
                                value[last_index] = last_object;
                                last_object = value;
                            } else {
                                last_object = value;
                            }

                            last_index = index;
                        });

                        var tmp = {};
                        tmp[last_index] = last_object;
                        json = Tool.mergeObj(json, tmp);
                        continue;

                    } else {
                        json[key] = value;
                    }

                }

                payload = JSON.stringify(json);

                break;

            default:
                payload = that.request_data;
                break;
        }


        await new Promise(function (resolve, reject) {
            that.ajax = $.ajax({
                type: that.method,
                url: that.url,
                data: payload,
                processData: false,
                contentType: that.contentType,
                cache: false,
                beforeSend: function () {

                    if (that.start_loader == true) {
                        loader.on();
                    }

                    that.before_function();
                },
                error: function () {},
                success(response) {},
                statusCode: {
                    301: function () {
                        location.reload();
                    }
                },
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.onprogress = function e() {};
                    xhr.upload.onprogress = function (e) {};
                    return xhr;
                },
            }).always(function (response, type, data) {

                if (typeof data == "object") {
                    try {
                        if (data.hasOwnProperty("responseText") && !data.hasOwnProperty("responseJSON")) {
                            data.responseJSON = JSON.parse(data.responseText);
                        }
                    } catch (error) {
                        output.debug.error(error);
                    }
                }
                var plus_delay = 200;

                function handleJSON() {
                    that.success = true;



                    if (that.history == true) {
                        nfclipboard.history.add(that.url);
                    }

                    if (that.rNext == true) {
                        that.next().then(function (delay) {
                            if (that.listen == true) {
                                setTimeout(function () {
                                    loader.off();
                                    app.listenner.listen();
                                    if (then != null) {
                                        then(that);
                                    }
                                }, delay + plus_delay);
                            }
                        });
                    }



                    if (that.rNext !== true) {
                        loader.off();
                        setTimeout(function () {
                            app.listenner.listen();
                            if (then != null) {
                                then(that);
                            }
                        }, that.callback_timeout);
                    }

                    return that;
                };

                function handleERROR(message, status) {
                    loader.off();
                    setTimeout(function () {
                        var errorMessage = status + ": " + (typeof env.language.error[status] == "undefined" ? message : env.language.error[status]);
                        if (that.rNext == true) {
                            output.alert(errorMessage);
                        }
                        if (then != null) {
                            then(that.response);
                        }
                        //that.response = errorMessage;
                    }, that.callback_timeout);
                    return that;
                };

                if (data.hasOwnProperty("responseJSON")) {
                    that.response = data.responseJSON;
                    return handleJSON();
                }

                if (response.hasOwnProperty("responseJSON")) {
                    that.response = response.responseJSON;

                    if (!response.responseJSON.hasOwnProperty("data")) {
                        return handleERROR(response.statusText, response.status);
                    }

                    return handleJSON();
                }

                if (type === "error" && response.hasOwnProperty("responseText")) {
                    return handleERROR(response.responseText, response.status);
                }

            });


        });

        return this;
    }
};

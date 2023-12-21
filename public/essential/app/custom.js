/**
 * Chart.Js Initializer

 */
"use strict";

const chart_colors = [
    "#000080", "#2d5a27", "#169509", "#bc6e06", "#ff8ae5", "#ffbcec", "#f8caef", "#f4a5c4",
    "#dccbe7", "#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#00FFFF", "#FF00FF", "#C0C0C0",
    "#f3bdd7", "#8b5e9e", "#dd90ee", "#b48487", "#8463f6", "#a7515b", "#848e00", "#301b30",
];



const _ChartJs = {
    initilized: false,
    init: function () {
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        this.initilized = true;
    },
    parseJson: function (obj) {
        var json;
        try {
            if (typeof obj === "object") {
                json = obj;
            } else {
                json = JSON.parse(obj);
            }
        } catch (error) {
            json = JSON.parse("{}");
        }
        return json;
    },
    initChart: function (selector, obj, name, display_title = false, chartType = "bar") {
        if (this.initialized == false) {
            this.init
        }
        var json = this.parseJson(obj);

        try {
            new Chart($(selector), {
                type: chartType,
                data: {
                    labels: Object.keys(json),
                    datasets: [{
                        label: (name === null || name === "") ? "" : name,
                        backgroundColor: chart_colors,
                        data: Object.values(json)
                    }]
                },
                options: {
                    title: {
                        display: display_title,
                        text: name
                    }
                }
            });

        } catch (error) {
            console.error(error);
        }

    },
    pie: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "pie");
    },
    bar: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "bar");
    },
    line: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "line");
    },
    radar: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "radar");
    },
    polar: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "polarArea");
    },
    doug: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "doughnut");
    },
    hBar: function (selector, obj, name, display_title = false) {
        this.initChart(selector, obj, name, display_title = false, "horizontalBar");
    },
}





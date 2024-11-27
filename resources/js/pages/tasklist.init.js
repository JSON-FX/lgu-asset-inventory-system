/*
Template Name: Dason - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: Task list Init Js File
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function (value) {
        var newValue = value.replace(' ', '');
        if (newValue.indexOf('--') != -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
            if (color) return color;
        } else {
            return newValue;
        }
    })
}

var barchartColors = getChartColorsArray("#task-chart");
var options = {
    chart: {
        height: 280,
        type: 'line',
        stacked: false,
        toolbar: {
            show: false,
        }
    },
    stroke: {
        width: [0, 2, 5],
        curve: 'smooth'
    },
    plotOptions: {
        bar: {
        columnWidth: '20%',
        endingShape: 'rounded'
        }
    },
    colors: barchartColors,
    series: [{
        name: 'Complete Tasks',
        type: 'column',
        data: [45, 26, 36, 27, 40, 28, 52]
    },
    {
        name: 'All Tasks',
        type: 'line',
        data: [45, 26, 46, 27, 40, 50, 62]
    }],
    fill: {
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
    },
    labels: ['Mon','Tue','Wed','The','Fri','Sat','Sun'],
    markers: {
        size: 0
    },

    yaxis: {
        min: 0
    },
    }

    var chart = new ApexCharts(
    document.querySelector("#task-chart"),
    options
    );

    chart.render();
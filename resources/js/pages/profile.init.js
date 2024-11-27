/*
Template Name: Dason - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: profile Js File
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

var barchartColors = getChartColorsArray("#overview-chart");
var options = {

    chart: {
    height: 290,
    type: 'bar',
    toolbar: {
        show: false,
    }
    },
    plotOptions: {
    bar: {
        columnWidth: '20%',
        endingShape: 'rounded',
        borderRadius: 6
    }
    },
    dataLabels: {
    enabled: false
    },

    series: [{
    name: 'Overview',
    data: [52, 66, 50, 74, 36, 52, 66]
    }],
    grid: {
        yaxis: {
            lines: {
                show: false,
            }
        }
    },
    yaxis: {
        labels: {
            formatter: function (value) {
                return value + "hrs";
            }
        },
        title: {
            text: '% (Percentage)'
        }
    },
    xaxis: {
        labels: {
            rotate: -90
        },
        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        title: {
                text: 'Week',
        }
    },
    colors: barchartColors,


    }

    var chart = new ApexCharts(
    document.querySelector("#overview-chart"),
    options
    );

    chart.render();

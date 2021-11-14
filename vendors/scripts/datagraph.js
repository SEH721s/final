var options = {
    series: [


    ],
    chart: {
        height: 300,
        type: 'area',
        zoom: {
            enabled: false,
        },
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 16,
            opacity: 0.2
        },
        toolbar: {
            show: false
        }
    },
    noData: {
        text: "No Data to show"
    },
    colors: ['#f0746c', '#255cd3'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: [3, 3],
        curve: 'smooth'
    },
    grid: {
        show: false,
    },
    markers: {
        colors: ['#f0746c', '#255cd3'],
        size: 5,
        strokeColors: '#ffffff',
        strokeWidth: 2,
        hover: {
            sizeOffset: 2
        }
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    yaxis: {
        min: 0,
        max: 400,
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: 0,
        labels: {
            useSeriesColors: true
        },
        markers: {
            width: 10,
            height: 10,
        }
    }
};

var options2 = {
    series: [70, 40],
    chart: {
        height: 200,
        type: 'donut',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function(w) {
                        return 260
                    }
                }
            }
        }
    },
    labels: ['Foreign', 'Namibian'],
};

var options3 = {
    series: [100, 10],
    chart: {
        height: 200,
        type: 'donut',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function(w) {
                        return 260
                    }
                }
            }
        }
    },
    labels: ['Full-Time', 'Part-Time'],
};

var options5 = {
    series: [50, 60],
    chart: {
        height: 200,
        type: 'donut',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function(w) {
                        return 260
                    }
                }
            }
        }
    },
    labels: ['Males', 'Females'],
};

var options6 = {
    series: [1, 2],
    chart: {
        height: 200,
        type: 'donut',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function(w) {
                        return 260
                    }
                }
            }
        }
    },
    labels: ['Medical Leave', 'Casual Leave'],
};

var options7 = {
    series: [70, 70, 50],
    chart: {
        height: 200,
        type: 'donut',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function(w) {
                        return 260
                    }
                }
            }
        }
    },
    labels: ['Behavioral Competencies', 'Key Performance Areas', 'Psychometrics'],
};

var chart = new ApexCharts(document.querySelector("#activities-chart"), options);
chart.render();
var url = 'https://my-json-server.typicode.com/SEH721s/final/db';



$.getJSON(url, function(response) {

    chart.updateSeries([{
            name: 'Staff on leave in 2020',
            data: response.year1
        },
        {
            name: 'Staff on leave in 2021',
            data: response.year2
        }

    ])

});


var chart2 = new ApexCharts(document.querySelector("#appointment-chart"), options2);
chart2.render();

var chart3 = new ApexCharts(document.querySelector("#surgery-chart"), options3);
chart3.render();

var chart4 = new ApexCharts(document.querySelector("#application-chart"), options5);
chart4.render();

var leaveChart = new ApexCharts(document.querySelector("#leave-chart"), options6);
leaveChart.render();

var performanceChart = new ApexCharts(document.querySelector("#performance-chart"), options7);
performanceChart.render();
// datatable init
$('document').ready(function() {
    $('.data-table').DataTable({
        scrollCollapse: false,
        autoWidth: false,
        responsive: true,
        searching: false,
        bLengthChange: false,
        bPaginate: true,
        bInfo: false,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [
            [5, 25, 50, -1],
            [5, 25, 50, "All"]
        ],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            paginate: {
                next: '<i class="ion-chevron-right"></i>',
                previous: '<i class="ion-chevron-left"></i>'
            }
        },
    });
});
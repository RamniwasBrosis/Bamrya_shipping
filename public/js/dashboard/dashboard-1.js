

(function($) {
    /* "use strict" */
	
 var dzChartlist = function(){
	
	var screenWidth = $(window).width();
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	var NewCustomers = function(){
		var options = {
		  series: [
			{
				name: 'Net Profit',
				data: [100,300, 200, 250, 200, 240, 180,230,200, 250, 300],
				/* radius: 30,	 */
			}, 				
		],
			chart: {
			type: 'area',
			height: 40,
			//width: 400,
			toolbar: {
				show: false,
			},
			zoom: {
				enabled: false
			},
			sparkline: {
				enabled: true
			}
			
		},
		
		colors:['var(--primary)'],
		dataLabels: {
		  enabled: false,
		},

		legend: {
			show: false,
		},
		stroke: {
		  show: true,
		  width: 2,
		  curve:'straight',
		  colors:['var(--primary)'],
		},
		
		grid: {
			show:false,
			borderColor: '#eee',
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: -1

			}
		},
		states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
		xaxis: {
			categories: ['Jan', 'feb', 'Mar', 'Apr', 'May', 'June', 'July','August', 'Sept','Oct'],
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			labels: {
				show: false,
				style: {
					fontSize: '12px',

				}
			},
			crosshairs: {
				show: false,
				position: 'front',
				stroke: {
					width: 1,
					dashArray: 3
				}
			},
			tooltip: {
				enabled: true,
				formatter: undefined,
				offsetY: 0,
				style: {
					fontSize: '12px',
				}
			}
		},
		yaxis: {
			show: false,
		},
		fill: {
		  opacity: 0.9,
		  colors:'var(--primary)',
		  type: 'gradient', 
		  gradient: {
			colorStops:[ 
				
				{
				  offset: 0,
				  color: 'var(--primary)',
				  opacity: .4
				},
				{
				  offset: 0.6,
				  color: 'var(--primary)',
				  opacity: .4
				},
				{
				  offset: 100,
				  color: 'white',
				  opacity: 0
				}
			  ],
			  
			}
		},
		tooltip: {
			enabled:false,
			style: {
				fontSize: '12px',
			},
			y: {
				formatter: function(val) {
					return "$" + val + " thousands"
				}
			}
		}
		};

		var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers"), options);
		chartBar1.render();
	 
	}
	var NewExperience = function(){
		var options = {
		  series: [
			{
				name: 'Net Profit',
				data: [100,300, 200, 250, 200, 240, 180,230,200, 250, 300],
				/* radius: 30,	 */
			}, 				
		],
			chart: {
			type: 'area',
			height: 40,
			//width: 400,
			toolbar: {
				show: false,
			},
			zoom: {
				enabled: false
			},
			sparkline: {
				enabled: true
			}
			
		},
		
		colors:['var(--primary)'],
		dataLabels: {
		  enabled: false,
		},

		legend: {
			show: false,
		},
		stroke: {
		  show: true,
		  width: 2,
		  curve:'straight',
		  colors:['#FF5E5E'],
		},
		
		grid: {
			show:false,
			borderColor: '#eee',
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: -1

			}
		},
		states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
		xaxis: {
			categories: ['Jan', 'feb', 'Mar', 'Apr', 'May', 'June', 'July','August', 'Sept','Oct'],
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			labels: {
				show: false,
				style: {
					fontSize: '12px',
				}
			},
			crosshairs: {
				show: false,
				position: 'front',
				stroke: {
					width: 1,
					dashArray: 3
				}
			},
			tooltip: {
				enabled: true,
				formatter: undefined,
				offsetY: 0,
				style: {
					fontSize: '12px',
				}
			}
		},
		yaxis: {
			show: false,
		},
		fill: {
		  opacity: 0.9,
		  colors:'#FF5E5E',
		  type: 'gradient', 
		  gradient: {
			colorStops:[ 
				
				{
				  offset: 0,
				  color: '#FF5E5E',
				  opacity: .5
				},
				{
				  offset: 0.6,
				  color: '#FF5E5E',
				  opacity: .5
				},
				{
				  offset: 100,
				  color: 'white',
				  opacity: 0
				}
			  ],
			  
			}
		},
		tooltip: {
			enabled:false,
			style: {
				fontSize: '12px',
			},
			y: {
				formatter: function(val) {
					return "$" + val + " thousands"
				}
			}
		}
		};

		var chartBar1 = new ApexCharts(document.querySelector("#NewExperience"), options);
		chartBar1.render();
	 
	}
	var AllProject = function(){
		var options = {
			series: [12, 30, 20],
         chart: {
			type: 'donut',
			width: 150,
		},
       plotOptions: {
			pie: {
			  donut: {
				size: '80%',
				labels: {
					show: true,
					name: {
						show: true,
						offsetY: 12,
					},
					value: {
						show: true,
						fontSize: '22px',
						fontFamily:'Arial',
						fontWeight:'500',
						offsetY: -17,
					},
					total: {
						show: true,
						fontSize: '11px',
						fontWeight:'500',
						fontFamily:'Arial',
						label: 'Compete',
					   
						formatter: function (w) {
						  return w.globals.seriesTotals.reduce((a, b) => {
							return a + b
						  }, 0)
						}
					}
				}
			  }
			}
		},
		 legend: {
                show: false,
            },
		 colors: ['#3AC977', 'var(--primary)', 'var(--secondary)'],
			labels: ["Compete", "Pending", "Not Start"],
			dataLabels: {
				enabled: false,
			},
        };
		var chartBar1 = new ApexCharts(document.querySelector("#AllProject"), options);
		chartBar1.render();
	 
	}
	
	var overviewChartInstance = null;
	function overiewChart(salesData, purchaseData, labels, jobsOfMonth) {

        // OLD CHART DESTROY
        if (overviewChartInstance !== null && typeof overviewChartInstance.destroy === "function") {
            overviewChartInstance.destroy();
        }
    
        var options = {
            series: [
                {
                    name: 'Total Sale of This Month',
                    type: 'column',
                    data: salesData
                }, 
                {
                    name: 'Total Purchase of This Month',
                    type: 'area',
                    data: purchaseData
                },
                {
                    name: 'Total Jobs of This Month',
                     type: 'line',
                    data: jobsOfMonth
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: { show: false },
            },
            stroke: {
                width: [0, 2, 3],
                curve: 'smooth'
            },
            legend: {
                fontSize: '13px',
                fontFamily: 'poppins',
                labels: { colors:'#888888' }
            },
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    borderRadius: 6,
                }
            },
            fill: {
                type: ['solid', 'gradient', 'solid'],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    colorStops : [
                        [
                            { offset: 0, color: 'var(--primary)', opacity: 1 },
                            { offset: 100, color: 'var(--primary)', opacity: 1 }
                        ],
                        [
                            { offset: 0, color: '#3AC977', opacity: 1 },
                            { offset: 40, color: '#3AC977', opacity: .15 },
                            { offset: 100, color: '#3AC977', opacity: 0 }
                        ]
                    ],
                    stops: [0, 100, 100, 100]
                }
            },
            colors:["var(--primary)", "#3AC977", "#FF9800"],
            labels: labels,
            markers: { size: 4 },
            xaxis: {
                categories: labels,
                labels: {
                    style: { fontSize: '13px', colors:'#888888' }
                },
            },
            yaxis: [
                {
                    title: { text: 'Sales', style: { color: "#1E88E5" } },
                    labels: { formatter: function(val){ return val; } }
                },
                {
                    opposite: true,
                    title: { text: 'Purchases', style: { color: "#3AC977" } },
                    labels: { formatter: function(val){ return val; } }
                },
                {
                    opposite: true,
                    title: { text: 'Jobs', style: { color: "#FF9800" } },
                    labels: { formatter: function(val){ return val; } }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        return y;
                    }
                }
            }
        };
        // STORE INSTANCE GLOBAL
        overviewChartInstance = new ApexCharts(document.querySelector("#overiewChart"), options);
        overviewChartInstance.render();
    }

	// Function to load chart data from server
    function loadChartData(period, fy = '') {
        let url = '/dashboard/chart-data/' + period;
    
        if (fy !== '') {
            url += '?fy=' + fy;
        }
    
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
        
                if (response.success) {
                    
                    const jobsArray = response.labels.map((month, idx) => {
                        // FY months start from April → March
                        let year = (idx < 9) ? response.fyStartYear : response.fyEndYear; // optional, or hardcode
                        let monthNum = String(idx + 4 <= 12 ? idx + 4 : idx - 8).padStart(2, '0');
                        let key = `${year}-${monthNum}`;
                        return response.jobsOfMonth[key] ?? 0;
                    });
    
                    overiewChart(response.sales, response.purchases, response.labels, jobsArray);
                    
                    document.getElementById('totalJobs').innerText = response.jobs;
                    
                    let ts = '₹ ' + Math.round(response.totalSales).toLocaleString('en-IN');
                    document.getElementById('totalSales').innerText = ts;
                    
                    let tp = '₹ ' + Math.round(response.totalPurchases).toLocaleString('en-IN');
                    document.getElementById('totalPurchases').innerText = tp;
                }
            }
        });
    }

    // Tab click event handler
    $("#financial-year").on("change", function () {
        var fy = $(this).val();   // e.g. "2024-25"
        if (fy !== "") {
            loadChartData("year", fy);   // Load FY specific chart
        } else {
            loadChartData("all");        // If no FY selected show "All"
        }
    });
    
    

   // MONTH WISE JOBS CHARTS
    var monthWiseChartInstance = null;
	function monthWiseOveriewChart(airImports, airExports, seaImports, seaExports, labels) {

        // OLD CHART DESTROY
        if (monthWiseChartInstance !== null && typeof monthWiseChartInstance.destroy === "function") {
            monthWiseChartInstance.destroy();
        }
    
        var mwOptions = {
            series: [
                {
                    name: 'Total AirImport Jobs of This Month',
                    type: 'column',
                    data: airImports
                }, 
                {
                    name: 'Total AirExport Jobs of This Month',
                    type: 'area',
                    data: airExports
                },
                {
                    name: 'Total SeaImport Jobs of This Month',
                     type: 'line',
                    data: seaImports
                },
                {
                    name: 'Total SeaExport Jobs of This Month',
                     type: 'line',
                    data: seaExports
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: { show: false },
            },
            stroke: {
                width: [0, 2, 3],
                curve: 'smooth'
            },
            legend: {
                fontSize: '13px',
                fontFamily: 'poppins',
                labels: { colors:'#888888' }
            },
            legend: {
                fontSize: '13px',
                fontFamily: 'poppins',
                labels: { colors:'#000' }
            },
            plotOptions: {
                bar: {
                    columnWidth: '40%',
                    borderRadius: 6,
                }
            },
            fill: {
                type: ['solid', 'gradient', 'solid'],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    colorStops : [
                        [
                            { offset: 0, color: 'var(--primary)', opacity: 1 },
                            { offset: 100, color: 'var(--primary)', opacity: 1 }
                        ],
                        [
                            { offset: 0, color: '#3AC977', opacity: 1 },
                            { offset: 40, color: '#3AC977', opacity: .15 },
                            { offset: 100, color: '#3AC977', opacity: 0 }
                        ]
                    ],
                    stops: [0, 100, 100, 100]
                }
            },
            colors:["var(--primary)", "#3AC977", "#FF9800", "#ef0aea"],
            labels: labels,
            markers: { size: 4 },
            xaxis: {
                categories: labels,
                labels: {
                    style: { fontSize: '13px', colors:'#888888' }
                },
            },
            yaxis: [
                {
                    title: { text: 'AIRIMP', style: { color: "#1E88E5" } },
                    labels: { formatter: function(val){ return val; } }
                },
                {
                    title: { text: 'AIREXP', style: { color: "#3AC977" } },
                    labels: { formatter: function(val){ return val; } }
                },
                {
                    opposite: true,
                    title: { text: 'SEAIMP', style: { color: "#FF9800" } },
                    labels: { formatter: function(val){ return val; } }
                },
                {
                    opposite: true,
                    title: { text: 'SEAEXP', style: { color: "#ef0aea" } },
                    labels: { formatter: function(val){ return val; } }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        return y;
                    }
                }
            }
        };
        
        // STORE INSTANCE GLOBAL
        monthWiseChartInstance = new ApexCharts(document.querySelector("#monthWise_overiewChart"), mwOptions);
        monthWiseChartInstance.render();
    }
    
    function monthWiseJobs(period, fy = '') {
        let url = '/dashboard/month-wise/chart-data/' + period;
    
        if (fy !== '') {
            url += '?fy=' + fy;
        }
    
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                console.log('response 000111222YY.', response)
                if (response.success) {
                    const airImports  = mapMonthlyData(response.airImports, response.fyStartYear, response.fyEndYear);
                    const airExports  = mapMonthlyData(response.airExports, response.fyStartYear, response.fyEndYear);
                    const seaImports  = mapMonthlyData(response.seaImports, response.fyStartYear, response.fyEndYear);
                    const seaExports  = mapMonthlyData(response.seaExports, response.fyStartYear, response.fyEndYear);
        
                    monthWiseOveriewChart( airImports, airExports, seaImports, seaExports, response.labels);
                }
            }
        });
    }
    
    function mapMonthlyData(dataObj, fyStartYear, fyEndYear) {
        const months = [
            '04','05','06','07','08','09',
            '10','11','12','01','02','03'
        ];
    
        return months.map(month => {
            let year = (month >= '04') ? fyStartYear : fyEndYear;
            let key = `${year}-${month}`;
            return dataObj[key] ?? 0;
        });
    }

	
	
	
	
	
	
	var earningChart = function(){
		
		var chartWidth = $("#earningChart").width();
		/* console.log(chartWidth); */
		
		var options = {
		  series: [
			{
				name: 'Net Profit',
				data: [700,650, 680, 600, 700, 610,710,620],
				/* radius: 30,	 */
			}, 				
		],
			chart: {
			type: 'area',
			height: 350,
			width: chartWidth + 55,
			toolbar: {
				show: false,
			},
			offsetX:-45,
			zoom: {
				enabled: false
			},
			/* sparkline: {
				enabled: true
			} */
			
		},
		
		colors:['var(--primary)'],
		dataLabels: {
		  enabled: false,
		},

		legend: {
			show: false,
		},
		stroke: {
		  show: true,
		  width: 2,
		  curve:'straight',
		  colors:['var(--primary)'],
		},
		grid: {
			show:true,
			borderColor: '#eee',
			xaxis: {
				lines: {
					show: true
				}
			},   
			yaxis: {
				lines: {
					show: false
				}
			},  
		},
		yaxis: {
			 show: true,
			 tickAmount: 4,
			  min: 0,
				max: 800,
				labels:{
					offsetX:50,
				}
		},
		xaxis: {
			categories: ['','May ', 'June', 'July', 'Aug', 'Sep ', 'Oct'],
			overwriteCategories: undefined,
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			labels: {
				show: true,
				offsetX:5,
				style: {
					fontSize: '12px',

				}
			},
		},
		fill: {
		  opacity: 0.5,
		  colors:'var(--primary)',
		  type: 'gradient', 
		  gradient: {
			colorStops:[ 
				
				{
				  offset: 0.6,
				  color: 'var(--primary)',
				  opacity: .2
				},
				{
				  offset: 0.6,
				  color: 'var(--primary)',
				  opacity: .15
				},
				{
				  offset: 100,
				  color: 'white',
				  opacity: 0
				}
			  ],
			  
			}
		},
		tooltip: {
			enabled:true,
			style: {
				fontSize: '12px',
			},
			y: {
				formatter: function(val) {
					return "$" + val + ""
				}
			}
		}
		};

		var chartBar1 = new ApexCharts(document.querySelector("#earningChart"), options);
		chartBar1.render();
		
		$(".earning-chart .nav-link").on('click',function(){
			var seriesType = $(this).attr('data-series');
			var columnData = [];
			switch(seriesType) {
				case "day":
					columnData = [700,650, 680, 650, 700, 610,710,620];
					break;
				case "week":
					columnData = [700,700, 680, 600, 700, 620,710,620];
					break;
				case "month":
					columnData = [700,650, 690, 640, 700, 670,710,620];
					break;
				case "year":
					columnData = [700,650, 590, 650, 700, 610,710,630];
					break;
				default:
					columnData = [700,650, 680, 650, 700, 610,710,620];
			}
			chartBar1.updateSeries([
				{
					name: "Net Profit",
					data: columnData
				}
			]);
		})
	 
	}
	var projectChart = function(){
		var options = {
			series: [30, 40, 20, 10],
         chart: {
			type: 'donut',
			width: 250,
		},
       plotOptions: {
			pie: {
			  donut: {
				size: '90%',
				labels: {
					show: true,
					name: {
						show: true,
						offsetY: 12,
					},
					value: {
						show: true,
						fontSize: '24px',
						fontFamily:'Arial',
						fontWeight:'500',
						offsetY: -17,
					},
					total: {
						show: true,
						fontSize: '11px',
						fontWeight:'500',
						fontFamily:'Arial',
						label: 'Total projects',
					   
						formatter: function (w) {
						  return w.globals.seriesTotals.reduce((a, b) => {
							return a + b
						  }, 0)
						}
					}
				}
			  }
			}
		},
		 legend: {
                show: false,
            },
		 colors: ['#FF9F00', 'var(--primary)', '#3AC977','#FF5E5E'],
			labels: ["Compete", "Pending", "Not Start"],
			dataLabels: {
				enabled: false,
			},
        };
		var chartBar1 = new ApexCharts(document.querySelector("#projectChart"), options);
		chartBar1.render();
	 
	}
	var handleWorldMap = function(trigger = 'load'){
		var vmapSelector = $('#world-map');
		if(trigger == 'resize')
		{
			vmapSelector.empty();
			vmapSelector.removeAttr('style');
		}
		
		vmapSelector.delay( 500 ).unbind().vectorMap({ 
			map: 'world_en',
			backgroundColor: 'transparent',
			borderColor: 'rgb(239, 242, 244)',
			borderOpacity: 0.25,
			borderWidth: 1,
			color: 'rgb(239, 242, 244)',
			enableZoom: true,
			hoverColor: 'rgba(239, 242, 244 0.9)',
			hoverOpacity: null,
			normalizeFunction: 'linear',
			scaleColors: ['#b6d6ff', '#005ace'],
			selectedColor: 'rgba(239, 242, 244 0.9)',
			selectedRegions: null,
			showTooltip: true,
			onRegionClick: function(element, code, region)
			{
				var message = 'You clicked "'
					+ region
					+ '" which has the code: '
					+ code.toUpperCase();
		 
				alert(message);
			}
		});
	}
	
	
	
	
	
	
	
	
	
	
	
	
	// Get current month
    let month = new Date().getMonth() + 1; // JavaScript months are 0-indexed (0 = January, 11 = December)
    
    // Calculate the financial year
    let year = new Date().getFullYear();
    let financialYear;
    
    if (month >= 4) {
        financialYear = year + '-' + (year + 1);
    } else {
        financialYear = (year - 1) + '-' + year;
    }
	
	
 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				NewCustomers();
				NewExperience();
				AllProject();
				// overiewChart();
				loadChartData(seriesType = 'year', fy = financialYear);
				monthWiseJobs(seriesType = 'year', fy = financialYear);
				earningChart();
				projectChart();
				handleWorldMap();
				
			},
			
			resize:function(){
				handleWorldMap();
				earningChart();
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);

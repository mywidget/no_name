// console.log(pathArray[3]);
if(pathArray[3]=='home'){
	var options = {
		chart: {
			type: "area",
			fontFamily: 'inherit',
			height: 240,
			parentHeightOffset: 0,
			toolbar: {
				show: true,
				offsetX: 0,
				offsetY: 0,
				tools: {
					download: true,
					selection: true,
					zoom: false,
					zoomin: false,
					zoomout: false,
					pan: false,
					reset: false | '<img src="/static/icons/reset.png" width="20">',
					customIcons: []
				},
				export: {
					csv: {
						filename: undefined,
						columnDelimiter: ',',
						headerCategory: 'category',
						headerValue: 'value',
						dateFormatter(timestamp) {
							return new Date(timestamp).toDateString()
						}
					},
					svg: {
						filename: undefined,
					},
					png: {
						filename: undefined,
					}
				},
				autoSelected: 'zoom' 
			},
			animations: {
				enabled: false
			},
			stacked: true,
		},
		plotOptions: {
			bar: {
				columnWidth: '50%',
			}
		},
		dataLabels: {
			enabled: false,
		},
		fill: {
			opacity: 1,
		},
		series: [],
		tooltip: {
			theme: 'dark'
		},
		grid: {
			padding: {
				top: -20,
				right: 0,
				left: -4,
				bottom: -4
			},
			strokeDashArray: 4,
			xaxis: {
				lines: {
					show: true
				}
			},
		},
		noData: {
			text: 'Loading...'
		},
		xaxis: {
			labels: {
				padding: 0,
			},
			tooltip: {
				enabled: false
			},
			axisBorder: {
				show: false,
			},
			type: 'category',
		},
		yaxis: {
			labels: {
				padding: 4,
				formatter: (value) => {
					return `${numberWithCommas(value)}`;
				},
			},
		},
		
		labels: [],
	}
	
	var chart = new ApexCharts(
		document.querySelector("#chart_penggunaan_satker"),
		options
	);
	
	// chart.render();
	// load_total_materiel();
	// load_materiel();
	function load_total_materiel(){
		var tanggal = $('#tanggal_materiel').val();
		var url = '/home/load_total_materiel_satker/?tanggal='+tanggal;
		
		$.getJSON(url, function(response) {
			var total = response.total;
			$('#load_total_materiel_satker').html(total);
			
		});
	}
	function load_materiel(){
		var tanggal = $('#tanggal_materiel').val();
		var url = '/home/chart_penggunaan_satker/?tanggal='+tanggal;
		
		$.getJSON(url, function(response) {
			
			var obj = response.data;
			
			chart.updateSeries([{
				name: 'Total',
				data: obj
			}])
			
		});
	}
	 
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
	}
}	

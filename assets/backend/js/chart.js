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
		document.querySelector("#chart_penggunaan"),
		options
	);
	
	// chart.render();
	// load_total_materiel();
	// load_materiel();
	function load_total_materiel(){
		var tanggal = $('#tanggal_materiel').val();
		var url = '/home/load_total_materiel/?tanggal='+tanggal;
		
		$.getJSON(url, function(response) {
			var total = response.total;
			$('#load_total_materiel').html(total);
			
		});
	}
	function load_materiel(){
		var tanggal = $('#tanggal_materiel').val();
		var url = '/home/chart_penggunaan/?tanggal='+tanggal;
		
		$.getJSON(url, function(response) {
			
			var obj = response.data;
			
			chart.updateSeries([{
				name: 'Total',
				data: obj
			}])
			
		});
	}
	
	// load_chart()
	function load_chart(){
		var tanggal = $('#tanggal_satker').val();
		$.ajax({
			url: '/home/chart_satker',
			method: "POST",
			data:{tanggal:tanggal},
			success: myCallback,
			error: function(data) {
				
			}
		});	
	}
	var series_forged = [];
	function myCallback (res)
	{
		
		var tag = [];
		var divisi = [];
		var tampil = [];
		var tampil2 = [];
		
		var series = [];
		
		for(var i in res) {
			
			tampil.push(res[i].data[1].hasil);
			
			divisi.push(res[i].divisi);
		}
		
		
		 var ByNameSIM = [];
		 var ByNameSTNK = [];
		 var ByNameBPKB = [];
		 var ByNameTNKB = [];
		 var ByNameSTCK = [];
		 var ByNameMutasi = [];
		 var ByNameskukp = [];
		 var ByNameNRKB = [];
		 var ByNameTCKB = [];
		
		var no = 1;
		for (var key in tampil){
			// console.log(tampil[key])
			var sim_name = tampil[key].SIM;
			var stnk_name = tampil[key].STNK;
			var bpkb_name = tampil[key].BPKB;
			var tnkb_name = tampil[key].TNKB;
			var stck_name = tampil[key].STCK;
			var mutasi_name = tampil[key].MUTASI;
			var skukp_name = tampil[key].SKUKP;
			var nrkb_name = tampil[key].NRKB;
			var tckb_name = tampil[key].TCKB;
			
			if (!ByNameSIM[sim_name]){
				ByNameSIM[sim_name] = [];
			}
			
			if (!ByNameSTNK[stnk_name]){
				ByNameSTNK[stnk_name] = [];
			}
			if (!ByNameBPKB[bpkb_name]){
				ByNameBPKB[bpkb_name] = [];
			}
			if (!ByNameTNKB[tnkb_name]){
				ByNameTNKB[tnkb_name] = [];
			}
			if (!ByNameSTCK[stck_name]){
				ByNameSTCK[stck_name] = [];
			}
			if (!ByNameMutasi[mutasi_name]){
				ByNameMutasi[mutasi_name] = [];
			}
			if (!ByNameskukp[skukp_name]){
				ByNameskukp[skukp_name] = [];
			}
			if (!ByNameTCKB[tckb_name]){
				ByNameTCKB[tckb_name] = [];
			}
			if (!ByNameNRKB[nrkb_name]){
				ByNameNRKB[nrkb_name] = [];
			}
			
			ByNameSIM.push(tampil[key].SIM.jml);
			ByNameSTNK.push(tampil[key].STNK.jml);
			ByNameBPKB.push(tampil[key].BPKB.jml);
			ByNameTNKB.push(tampil[key].TNKB.jml);
			ByNameSTCK.push(tampil[key].STCK.jml);
			ByNameMutasi.push(tampil[key].MUTASI.jml);
			ByNameskukp.push(tampil[key].SKUKP.jml);
			ByNameTCKB.push(tampil[key].TCKB.jml);
			ByNameNRKB.push(tampil[key].NRKB.jml);
			no++;
		}
		
		var optionsx = {
			chart: {
				type: 'area',
				height: 300,
				toolbar: {
					show: true,
				},
			},
			plotOptions: {
				bar: {
					columnWidth: '50%',
				}
			},
			dataLabels: {
				enabled: false,
			},
			
			
			series: [{
				name: "SIM",
				data: ByNameSIM
				},{
				name: "STNK",
				data: ByNameSTNK
				},{
				name: "BPKB",
				data: ByNameBPKB
				},{
				name: "TNKB",
				data: ByNameTNKB
				},{
				name: "TCKB",
				data: ByNameTCKB
				},{
				name: "STCK",
				data: ByNameSTCK
				},{
				name: "MUTASI",
				data: ByNameMutasi
				},{
				name: "SKUKP",
				data: ByNameskukp
				},{
				name: "NRKB",
				data: ByNameNRKB
			}],
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
					formatter: (value) => {
						return `${numberWithCommas(value)}`;
					},
				}
			},
			labels: divisi,
			colors:['#00008c', '#0036d9', '#00b3b2', '#00238c','#001a66', '#4C5AFC', '#598BF8', '#63BCEC', '#A0E6FF']
		}
		
		var chartS = new ApexCharts(document.querySelector("#chart_satker"), optionsx);
		
		chartS.render();
		chartS.resetSeries();
		
	}	
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
	}
}	

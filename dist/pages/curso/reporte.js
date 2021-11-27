$(function () {
	$("#selectCurso").select2();
	if (idCurso > 0) {
		$("#selectCurso").select2().val(idCurso).trigger("change");
	}
	$("#selectCurso").on("select2:select", function (e) {
		let selected = $("#selectCurso").select2("val");
		window.location = base_url + "curso/reporte/" + selected;
	});

	var currentdate = new Date();
	var datetime = currentdate.toISOString();

	$("#tableReport")
		.DataTable({
			paging: true,
			searching: false,
			ordering: true,
			info: true,
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			buttons: [
				{
					extend: "excel",
					title: ()=>"Reporte curso: "+ $("#selectCurso").select2("data")[0].text,
					messageBottom: "Fecha descarga: " + datetime,
				},
				{
					extend: "pdf",
					title: ()=>"Reporte curso: "+ $("#selectCurso").select2("data")[0].text,
					messageBottom: "Fecha descarga: " + datetime,
				},
				{
					extend: "print",
					title: ()=>"Reporte curso: "+ $("#selectCurso").select2("data")[0].text,
					messageBottom: "Fecha descarga: " + datetime,
				},
			],
		})
		.buttons()
		.container()
		.appendTo("#tableReport_wrapper .col-md-6:eq(0)");

	//-------------
	//- DONUT CHART -
	//-------------
	// Get context with jQuery - using jQuery's .get() method.
	var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
	var donutData = {
		labels: ["Terminados", "En progreso", "Sin Iniciar"],
		datasets: [
			{
				data: datoTotal,
				backgroundColor: ["#00a65a", "#3c8dbc", "#f56954"],
			},
		],
	};
	var donutOptions = {
		maintainAspectRatio: false,
		responsive: true,
	};
	//Create pie or douhnut chart
	// You can switch between pie and douhnut using the method below.
	new Chart(donutChartCanvas, {
		type: "doughnut",
		data: donutData,
		options: donutOptions,
	});
});

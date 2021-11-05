$(function () {
	$(".titulo").on("click", function (e) {
		e.preventDefault();
		console.log(this.id);
		$(".descripcion").hide();
		$("#desc-" + this.id).show();
		text_value = $("#desc-" + this.id)
			.next()
			.text();
		const obj = JSON.parse(text_value);
		$("#form_close").find("[name='DESCRIPCION_FIN']").val(obj.DESCRIPCION_FIN);
		$("#form_close")
			.find("[name='TERMINADO'][value='" + obj.TERMINADO + "']")
			.attr("checked", "checked");
		$("#form_suregencia").find("[name='SUGERENCIA']").val(obj.SUGERENCIA);
	});
	$("#form_close").submit(function (event) {
		event.preventDefault();
		let id_actividad = $(this).find("[name='ID_ACTIVIDAD']").val();
		let descripcion_fin = $(this).find("[name='DESCRIPCION_FIN']").val();
		let terminado = $(this).find("[name='TERMINADO']:checked").val();
		$.post(
			base_url + "actividad/terminar",
			{ id_actividad, descripcion_fin, terminado },
			function (data) {
				location.reload();
				return false;
			}
		);
	});
	$("#form_suregencia").submit(function (event) {
		event.preventDefault();
		let id_actividad = $(this).find("[name='ID_ACTIVIDAD']").val();
		let sugerencia = $(this).find("[name='SUGERENCIA']").val();
		$.post(
			base_url + "actividad/sugerir",
			{ id_actividad, sugerencia },
			function (data) {
				location.reload();
				return false;
			}
		);
	});
});

const setIdTerminar = (id_actividad) => {
	$("#close_actividad").val(id_actividad);
};

const setIdSugerencia = (id_actividad) => {
	$("#sugerencia_actividad").val(id_actividad);
};

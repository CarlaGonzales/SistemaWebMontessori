$("#summernote").summernote({
	lang: "es-ES",
	placeholder: "Por favor ingrese su descripcion",
	tabsize: 2,
	height: 150,
	toolbar: [
		["style", ["style"]],
		["font", ["bold", "underline", "clear"]],
		["color", ["color"]],
		["para", ["ul", "ol", "paragraph"]],
		["table", ["table"]],
		["insert", ["link", "picture", "video"]],
		["view", ["fullscreen", "codeview", "help"]],
	],
});

$(".select2").select2();

$(".selectSearch").select2();

$(".selectSearch").on("select2:select", function (e) {
	let selected = $(".selectSearch").select2("val").join("-");
	window.location = base_url + "curso/miscursos/" + selected;
});
$(".selectSearch").on("select2:unselect", function (e) {
	let selected = $(".selectSearch").select2("val").join("-");
	window.location = base_url + "curso/miscursos/" + selected;
});

$(function () {
	$(".titulo").on("click", function (e) {
		e.preventDefault();
		console.log(this.id);
		$(".descripcion").hide();
		$("#desc-" + this.id).show();
	});
});

const ventana = () => {
	alert("mostrar");
};

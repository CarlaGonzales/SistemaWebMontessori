Dropzone.autoDiscover = false;
$(function () {
	
	$("#dZUploadImg").dropzone({
		url: "../../upload",
        maxFiles: 1,
        uploadMultiple: false,
		addRemoveLinks: true,
        //acceptedFiles: "application/vnd.oasis.opendocument.text,application/rtf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,.xls,.xlsx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,.ppt,.pptx,image/*,.mp3,.m4a,.ogg,.wav,.wma",
        acceptedFiles: "image/*",
		success: function (file, response) {
			var imgName = response;
			file.previewElement.classList.add("dz-success");
			console.log("Successfully uploaded :" + imgName.name);
            if(imgName.uploaded){
                $("#IMAGEN").val(imgName.name);
            }
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		},
	});

    $("#dZUploadAud").dropzone({
		url: "../../upload",
        maxFiles: 1,
        uploadMultiple: false,
		addRemoveLinks: true,
        //acceptedFiles: "application/vnd.oasis.opendocument.text,application/rtf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,.xls,.xlsx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,.ppt,.pptx,image/*,.mp3,.m4a,.ogg,.wav,.wma",
        acceptedFiles: ".mp3,.m4a,.ogg,.wav,.wma",
		success: function (file, response) {
			var imgName = response;
			file.previewElement.classList.add("dz-success");
			console.log("Successfully uploaded :" + imgName.name);
            if(imgName.uploaded){
                $("#AUDIO").val(imgName.name);
            }
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		},
	});

    $("#dZUploadVdo").dropzone({
		url: "../../upload",
        maxFiles: 1,
        uploadMultiple: false,
		addRemoveLinks: true,
        //acceptedFiles: "application/vnd.oasis.opendocument.text,application/rtf,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,.xls,.xlsx,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,.ppt,.pptx,image/*,.mp3,.m4a,.ogg,.wav,.wma",
        acceptedFiles: ".mp4,.avi",
		success: function (file, response) {
			var imgName = response;
			file.previewElement.classList.add("dz-success");
			console.log("Successfully uploaded :" + imgName.name);
            if(imgName.uploaded){
                $("#VIDEO").val(imgName.name);
            }
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		},
	});
});

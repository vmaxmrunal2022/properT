Dropzone.autoDiscover = false;
var dropzone = new Dropzone ("#image-upload", {
    // maxFilesize: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
    // autoProcessQueue: false,
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
    dictRemoveFile: "Remove",
});
dropzone.on("removedfile", function(file){
    let imageId = file.previewElement.querySelector(".dz-remove").getAttribute("data-image-id");
    // console.log(imageId);
    if(typeof(imageId) != "undefined" && imageId !== null) {
      $.ajax({
          type: "GET",
          url: apiUrl +"/surveyor/property/image/destroy/"+imageId,
          success: function(response) {
              // alert()
              // toastr.success('Image Removed Successfully.')
          }
      });
    }
});
dropzone.on("addedfile", function (file) {
    if (file instanceof File) {
      // Check if the file size is greater than 500 KB (500 * 1024 bytes)
      if (file.size > 500 * 1024) {
        // Read the file content to compare with existing files
        var reader = new FileReader();
        reader.onload = function (event) {
          var fileContent = event.target.result;
          var duplicate = false;
          // Loop through the existing files in the dropzone
          dropzone.files.forEach(function (existingFile) {
            if (existingFile !== file) {
              var existingReader = new FileReader();
              existingReader.onload = function (event) {
                var existingFileContent = event.target.result;
                // Compare the file content
                if (existingFileContent === fileContent) {
                  dropzone.removeFile(file);
                  duplicate = true;
                  return;
                }
              };
              existingReader.readAsDataURL(existingFile);
            }
          });
          if (!duplicate) {
            // If the file is not a duplicate, proceed with compression
            var compressor = new Compressor(file, {
              maxWidth: 800,
              maxHeight: 800,
              quality: 0.8,
              mimeType: "image/jpeg",
              success: function (result) {
                dropzone.removeFile(file);
                dropzone.addFile(result);
              },
              error: function (err) {
                console.error("File compression error:", err.message);
              },
            });
          }
        };
        reader.readAsDataURL(file);
      }
    }
  });

// dropzone.on("accept", function(file) {
//     // Remove the original file from the preview
//     var originalFiles = dropzone.getAcceptedFiles().filter(function(f) {
//         return f !== file;
//     });
//     dropzone.removeAllFiles();
//     originalFiles.forEach(function(f) {
//         dropzone.addFile(f);
//     });
// });
function logFileSize(file) {
    var fileSizeInMB = file.size / (1024 * 1024);
    console.log("Compressed file size:", fileSizeInMB.toFixed(2), "MB");
}
dropzone.on("success", function(file, response) {
    // Add the image ID as a data attribute to the remove button
    var removeButton = file.previewElement.querySelector(".dz-remove");
    if (removeButton) {
        removeButton.setAttribute("data-image-id", response.id);
    }
});


// dropzone.on("addedfile", function(file) {
//     dropzone.createThumbnail(
//         file,
//         dropzone.options.thumbnailWidth,
//         dropzone.options.thumbnailHeight,
//         dropzone.options.thumbnailMethod,
//         false,
//         function(dataURL) {
//             // Remove the original file from the Dropzone queue
//             dropzone.removeFile(file);
//             // Convert the data URL to a Blob object
//             var blob = dataURItoBlob(dataURL);
//             // Create a new File object with the compressed image
//             var compressedFile = new File([blob], file.name, { type: blob.type });
//             // Add the compressed file to the dropzone
//             dropzone.addFile(compressedFile);
//             logFileSize(compressedFile);
//             // alert('add triggered');
//         }
//     );
// });

// function dataURItoBlob(dataURI) {
//     var byteString = atob(dataURI.split(",")[1]);
//     var mimeString = dataURI.split(",")[0].split(":")[1].split(";")[0];
//     var ab = new ArrayBuffer(byteString.length);
//     var ia = new Uint8Array(ab);
//     for (var i = 0; i < byteString.length; i++) {
//         ia[i] = byteString.charCodeAt(i);
//     }
//     return new Blob([ab], { type: mimeString });
// }

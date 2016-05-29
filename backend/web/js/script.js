/**
 * Created by me on 5/23/16.
 */

function deleteImage(filePath, id){
 var confirmDelete = confirm("Витерти фото ?");
    if (confirmDelete == true) {
        window.location.href = getBaseUrl() + "/site/delete-photo?fileId=" + filePath + "&" + "productId=" + id;
    }
}

function setMainImage(filePath, id){
    var confirmDelete = confirm("Зробити головним ?");
    if (confirmDelete == true) {
        window.location.href = getBaseUrl() + "/site/set-main-image?fileId=" + filePath + "&" + "productId=" + id;
    }
}

function getBaseUrl(){
  pathArray = location.href.split( '/' );
  protocol = pathArray[0];
  host = pathArray[2];
   url = protocol + '//' + host;
 return url;
}
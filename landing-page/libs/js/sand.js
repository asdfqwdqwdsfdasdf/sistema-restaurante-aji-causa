function serialize(obj) {
    if (!obj || typeof obj !== 'object') {
            return;
    }
    let q = [];
    for (const prop in obj) {
        q.push(`${prop}=${encodeURIComponent(obj[prop])}`);
      }                 
    return q.join("&");
}

function requestSand(objData) {
    const xhr = new XMLHttpRequest();
    //req.onprogress = onProgress;
    xhr.open(objData.method, objData.url, true);
    xhr.onloadstart = objData.loadstart;
    xhr.onload =  () => {
        if (xhr.status == 200) {
            objData.success(xhr.response);
        } else {
            console.error('Error!');
        }
    }
    xhr.onerror = objData.error;
    xhr.timeout = objData.timeout;
    xhr.ontimeout = () => console.log('Request timeout.', xhr.responseURL);
    xhr.responseType = (objData.dataType)? objData.dataType:'text'; 
	if (objData.data == null) { 
        xhr.send();
	} else {
        if(objData.processData == null || objData.processData == true){
              xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xhr.setRequestHeader("Content-type", "application/json; charset=utf-8");
              xhr.send(serialize(objData.data));
        }else{
            xhr.send(objData.data);
        }
    }
}
function geturl() {
	var x = location.href;
	var r = x.split('/', 5);
	return r[0] + '//' + r[2] + '/' ;
	//return r[0] + '//' + r[2] + '/' + r[3] + '/' ;
}
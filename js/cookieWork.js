let ip;
async function getIp(){
    if (document.cookie == "") {
        await $.get("php/getIp.php",{}, (data) => {document.cookie = "ip="+data});
    }
    ip = parseInt(document.cookie.slice(3));
    return ip;
}

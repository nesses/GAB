/* 
 * @author Matthias Grotjohann
 */
function verifyUsername() {
    var request = new XMLHttpRequest();
   request.open("POST","index.php");
   request.addEventListener('load', function(event) {
      if (request.status >= 200 && request.status < 300) {
         console.log(request.responseText);
      } else {
         console.warn(request.statusText, request.responseText);
      }
      alert(request.responseText);
   });
   request.send("data");
}


function getElementByXpath(path) {
 return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}
function init_scrap() {
 let cantidad = getElementByXpath('/html/body/div[2]/div[1]/div/div[2]/div[2]/div[3]/div/div[2]/nav/span[2]').textContent.split(' of ')[1];
 let parametros = [];
 let formData = new FormData();
 for (let i = 2; i <= cantidad; i++) {
  nombre = getElementByXpath('/html/body/div[2]/div[1]/div/div[2]/div[2]/div[3]/div/div[1]/div/div/div[2]/div[' + i + ']/div[2]/div/div/div[1]')?.textContent.replace(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g, '');
  ;
  promedio_spl = getElementByXpath('/html/body/div[2]/div[1]/div/div[2]/div[2]/div[3]/div/div[1]/div/div/div[2]/div[' + i + ']/div[5]/div/div/div/div/div/div[1]/span').textContent.replace(' SLP', '');
  cantidad_copas = getElementByXpath('/html/body/div[2]/div[1]/div/div[2]/div[2]/div[3]/div/div[1]/div/div/div[2]/div[' + i + ']/div[7]/div/div/div/div/div[1]/div/span').textContent.replace(',', '');
  cantidad_spl_victoria = parseInt(getElementByXpath('/html/body/div[2]/div[1]/div/div[2]/div[2]/div[3]/div/div[1]/div/div/div[2]/div[' + i + ']/div[7]/div/div/div/div/div[2]').textContent.split('~')[1].split(' ')[0]);
  parametros.push({
   'nombre': nombre,
   'promedio_spl': promedio_spl,
   'cantidad_copas': cantidad_copas,
   'cantidad_spl_victoria': cantidad_spl_victoria
  })
 }
 var xmlHttp = new XMLHttpRequest();
 xmlHttp.onreadystatechange = function () {
  if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
   console.log(xmlHttp.responseText);
  }
 }
 formData.append('parametros', JSON.stringify(parametros));
 xmlHttp.open("post", "https://sejaalinfinity.com/core/scraping/guardarDatos.php");
 xmlHttp.send(formData);
}
init_scrap();
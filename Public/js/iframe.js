function calcPageHeight(doc) {
  var cHeight = Math.max(doc.body.clientHeight, doc.documentElement.clientHeight)
  var sHeight = Math.max(doc.body.scrollHeight, doc.documentElement.scrollHeight)
  var height = Math.max(cHeight, sHeight)
  return height
}
var ifr = document.getElementById('iframe')
ifr.onload = function() {
  var iDoc = ifr.contentDocument || ifr.document
  var height = calcPageHeight(iDoc)
  ifr.style.height = height + 'px'
}

// The list of image URLs
var urls = [
    'http://www.traveller.com.au/content/dam/images/g/u/n/q/h/0/image.related.articleLeadwide.620x349.gunpvd.png/1488330286332.png',
    'http://images.mentalfloss.com/sites/default/files/styles/mf_image_16x9/public/57159-istock-486456250.jpg?itok=pYToxS1l&resize=1100x619',
    'https://www.maxwaugh.com/wp-content/uploads/2016/04/quokka041816australia77.jpg',
    'https://d32xvgr96w2oxp.cloudfront.net/2017/03/quokka-ok-03-2017.jpg'
  ];
  
  // The index (serial number) of the current image
  var i = 0;
  
  // Grab handles onto HTML elements.
  var leftButton = document.getElementById('left');
  var rightButton = document.getElementById('right');
  var picture = document.getElementById('picture');
  
  // Retreat
  leftButton.onclick = function() {
    i = (i - 1 + urls.length) % urls.length;
    picture.src = urls[i]; 
  }
  
  // Advance
  rightButton.onclick = function() {
    i = (i + 1) % urls.length;
    picture.src = urls[i]; 
  }
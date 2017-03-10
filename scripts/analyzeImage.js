var c, ctx, img, imgd, pix;
window.setTimeout(init, 100);
	
function init() {
	var canvas = document.getElementById("analyzeCanvas");
	var context = canvas.getContext("2d");
	context.fillStyle = "#999999";
	context.font = "40px Georgia";
	context.fillText("Drag and drop", 20, 103);
	context.fillText("image here to", 26, 153);
	context.fillText("analyze it", 60, 203);
}

function dragStart(event) {
    c = document.getElementById("analyzeCanvas");
    ctx = c.getContext("2d");
    img = document.getElementById(event.target.id);
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
	ctx.clearRect(0, 0, c.width, c.height);
	document.getElementById("histogramCanvasR").getContext("2d").clearRect(0, 0, 256, 200);
	document.getElementById("histogramCanvasG").getContext("2d").clearRect(0, 0, 256, 200);
	document.getElementById("histogramCanvasB").getContext("2d").clearRect(0, 0, 256, 200);
    event.preventDefault();
    ctx.drawImage(img, 0, 0, 300, 300);
	imgd = ctx.getImageData(0, 0, 300, 300);
	pix = imgd.data;
	createHistogram();
}

function init2() {
	var canvas = document.getElementById("canvas");
	var context = canvas.getContext("2d");
	context.fillStyle = "#999999";
	context.font = "40px Georgia";
	context.fillText("Drag and drop", 20, 103);
	context.fillText("image here to", 26, 153);
	context.fillText("process it", 60, 203);
}

function dragStart2(event) {
    c = document.getElementById("canvas");
    ctx = c.getContext("2d");
    img = document.getElementById(event.target.id);
}

function allowDrop2(event) {
    event.preventDefault();
}

function drop2(event) {
	ctx.clearRect(0, 0, c.width, c.height);
    event.preventDefault();
    ctx.drawImage(img, 0, 0, 300, 300);
	imgd = ctx.getImageData(0, 0, 300, 300);
	pix = imgd.data;
}

function createHistogram() {
	var rarray = [];
	var garray = [];
	var barray = [];
	var aarray = [];
	
	for (var i = 0; i < 256; i++) {
		rarray[i] = 0;
		garray[i] = 0;
		barray[i] = 0;
		aarray[i] = 0;
	}
	
	var r, g, b, a;
	
	for (var i = 0, n = pix.length; i < n; i += 4) {
		r = pix[i];
		g = pix[i+1];
		b = pix[i+2];
		a = pix[i+3];
		rarray[r]++;
		garray[g]++;
		barray[b]++;
		aarray[a]++;
	}
	findMaxValues(rarray, garray, barray);
	getAverageColor(rarray, garray, barray);
}

function findMaxValues(rarray, garray, barray) {
	var rmax, gmax, bmax;
	rmax = gmax = bmax = 0;
	for (var x = 1; x < 256; x++){
		if (rmax < rarray[x])
			rmax = rarray[x];
		if (gmax < garray[x])
			gmax = garray[x];
		if (bmax < barray[x])
			bmax = barray[x];
	}

	drawHistogramR(rmax, rarray);
	drawHistogramG(gmax, garray);
	drawHistogramB(bmax, barray);
}

function drawHistogramR(rmax, rarray) {
	var canvas = document.getElementById("histogramCanvasR");
	canvas.style.visibility = 'visible';
	var context = canvas.getContext("2d");
	
	var val = 0;
	var oldPoints = cartToScreen(0, 0);
	var newPoints = cartToScreen(0, 0);
	for (var x = 1; x < 256; x++) {
		oldPoints = newPoints;
		val = Math.ceil(rarray[x] / rmax * 200);
		newPoints = cartToScreen(x, val);
		context.beginPath();
		context.moveTo(oldPoints[0], oldPoints[1]);
		context.lineTo(newPoints[0], newPoints[1]);
		context.strokeStyle = "red";
		context.lineWidth = 1;
		context.stroke();
	}
}

function drawHistogramG(gmax, garray) {
	var canvas = document.getElementById("histogramCanvasG");
	canvas.style.visibility = 'visible';
	var context = canvas.getContext("2d");
	
	var val = 0;
	var oldPoints = cartToScreen(0, 0);
	var newPoints = cartToScreen(0, 0);
	for (var x = 1; x < 256; x++) {
		oldPoints = newPoints;
		val = Math.ceil(garray[x] / gmax * 200);
		newPoints = cartToScreen(x, val);
		context.beginPath();
		context.moveTo(oldPoints[0], oldPoints[1]);
		context.lineTo(newPoints[0], newPoints[1]);
		context.strokeStyle = "green";
		context.lineWidth = 1;
		context.stroke();
	}
}

function drawHistogramB(bmax, barray) {
	var canvas = document.getElementById("histogramCanvasB");
	canvas.style.visibility = 'visible';
	var context = canvas.getContext("2d");
	
	var val = 0;
	var oldPoints = cartToScreen(0, 0);
	var newPoints = cartToScreen(0, 0);
	for (var x = 1; x < 256; x++) {
		oldPoints = newPoints;
		val = Math.ceil(barray[x] / bmax * 200);
		newPoints = cartToScreen(x, val);
		context.beginPath();
		context.moveTo(oldPoints[0], oldPoints[1]);
		context.lineTo(newPoints[0], newPoints[1]);
		context.strokeStyle = "blue";
		context.lineWidth = 1;
		context.stroke();
	}
}

function cartToScreen(px, py) {
	return [px, -py + 200];
}

function getAverageColor(rarray, barray, garray) {
	var canvas = document.getElementById("avgColorCanvas");
	var context = canvas.getContext("2d");
	var imgData = ctx.getImageData(0, 0, 200, 200);
	var pixels = imgData.data;
	
	var r, g, b;
	var rbucket, gbucket, bbucket;
	var count = 0;
	rbucket = gbucket = bbucket = 0.0;
	r = g = b = 0.0;
	for (var x = 0; x < pixels.length; x += 4) {
		r = pixels[x] / 256;
		g = pixels[x+1] / 256;
		b = pixels[x+2] / 256;
		rbucket += r;
		gbucket += g;
		bbucket += b;
		count++;
	}
	
	var avgr = Math.floor(rbucket / count * 256);
	var avgg = Math.floor(gbucket / count * 256);
	var avgb = Math.floor(bbucket / count * 256);
	var avgcolor = rgbToHex(avgr, avgg, avgb);
	
	context.fillStyle = avgcolor;
	context.fillRect(0, 0, 256, 50);
	document.getElementById("avgColorTitleLbl").innerText = 'Average Color: ';
	document.getElementById("avgColorLbl").innerText = "(" + avgr + ", " + avgg + ", " + avgb + ") " + rgbToHex(avgr, avgg, avgb);
}

function rgbToHex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}
/**
 * Created by Mitchell on 1/9/2015.
 */
(function() {
    var curOnLoad = window.onload;
    window.onload = function() {
        if (curOnLoad !== undefined && curOnLoad !== null) {
            curOnLoad();
        }
        //any extra stuff here
    };
}).call(this);
var canvasId = 'outputPane';

function handleShapeRequestResponse(ajax) {
    if (ajax.readyState === 4){
        if (ajax.status === 200) {
            var arr = JSON.parse(ajax.responseText);

            if (typeof arr === "object") {
                draw(arr);
            } else {
                console.log("Invalid response from shape request: " + arr);
            }
        }
    }
}

function requestShape(shapeName, sideLength){
    var ajax = new XMLHttpRequest();

    ajax.open("POST", "/api/ShapeServer.php");
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function() { handleShapeRequestResponse(ajax) };
    ajax.send("shape=" + shapeName + "&sideLength=" + sideLength);
}

function draw(pointList) {
    if (typeof pointList === "object") {
        var canvasElem = document.getElementById(canvasId);
        if (canvasId !== null && canvasId !== undefined) {
            var context = canvasElem.getContext("2d");

            if (context !== null) {
                context.fillStyle = "white";
                context.clearRect(0, 0, canvasElem.width, canvasElem.height);
                context.beginPath();
                context.moveTo(pointList[0].x, pointList[0].y);
                for (var i = 1; i < pointList.length; i++) {
                    context.lineTo(pointList[i].x, pointList[i].y);
                }
                context.lineTo(pointList[0].x, pointList[0].y);
                context.closePath();
                context.stroke();
            } else {
                console.log("Canvas is not supported by this browser.");
            }
        } else {
            console.log("Output canvas could not be found. Expecting a canvas with id: " + canvasId);
        }
    } else {
        console.log("Invalid argument passed to draw(). pointList type: " + typeof pointList);
    }
}




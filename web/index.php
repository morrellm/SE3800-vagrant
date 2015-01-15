<?php
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/9/2015
 * Time: 2:07 PM
 */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shapes!</title>
        <script type="application/javascript" src="scripts/clientRelay.js"></script>
    </head>
    <body>
        <div class="buttonPane">
            <button onclick="requestShape('supershape', 70)">Draw a Super-Shape!</button>
            <button onclick="requestShape('pentagon', 70)">Draw a Pentagon!</button>
            <button onclick="requestShape('hexagon', 70)">Draw a Hexagon!</button>
            <button onclick="requestShape('septagon', 70)">Draw a Septagon!</button>
            <button onclick="requestShape('octogon', 70)">Draw a Ocotogon!</button>
            <button onclick="requestShape('circle', 70)">Draw a Circle!</button>
            <button onclick="requestShape('Square', 70)">Draw a Square!</button>
            <button onclick="requestShape('triangle', 70)">Draw a Triangle!</button>
        </div>
        <canvas id="outputPane">
        </canvas>
    </body>
</html>
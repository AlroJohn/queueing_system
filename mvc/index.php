<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../images/divine_logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWCL Queueing System</title>
    <link rel="stylesheet" href="../css/styles_sixs.css">
    <style>
.split-buttons {
    display: none;
    margin-top:-40px;
}

.split-button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 0px;
    cursor: pointer;
}

.split-button:hover {
    background-color: #0056b3;
}

.split-buttons button {
    display: block;

}


    </style>
</head>
    <body>
    <main>
        <div class="background"></div>
        <div class="logo_img"><img src="../images/divine_logo.png" alt="Divine Word College of Legazpi"><p class="dwcl-tag">Divine Word College of Legazpi</p></div>
        <div class="top_logo"><p class="qeue">(Queueing System)</p></div>
        <div class="column">
            <div class="color-box" id="box1">
                <button id="Assessment">Assessment</button>  
            </div>
            <div class="color-box" id="box2">
                <button id="Cashier">Cashier </button>
            </div>
            <div class="color-box" id="box3">
                <button id="Registrars" class="split-button">Registrar</button>
                <div class="split-buttons">
                    <button id="Registrar1">Registrar 1</button>
                    <button id="Registrar2">Registrar 2</button>
                    <button id="Registrar3">Registrar 3</button>
                </div>
            </div>

        </div>
    </main>
    <script src="../function/function.js"></script>
    <script>
var registrarButton = document.getElementById("Registrars");
var splitButtons = document.querySelector(".split-buttons");
var closeButton = document.getElementById("CloseButton");

registrarButton.addEventListener("click", function () {
    if (splitButtons.style.display === "none") {
        splitButtons.style.display = "block";
    } else {
        splitButtons.style.display = "none";
    }
});




    </script>

</body>
</html>
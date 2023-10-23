// Define sendDataToServer function globally
function sendDataToServer(number, department) {
    fetch(`insert.php?number=${number}&department=${department}`)
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server if needed
            console.log("Insertion response:", data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const assessmentButton = document.getElementById("Assessment");
    const cashierButton = document.getElementById("Cashier");
    const registrarButton = document.getElementById("Registrar");

    assessmentButton.addEventListener("click", function () {
        fetch(`generate.php?number=${assessmentButton.getAttribute("data-number") || 1}`)
            .then(response => response.json())
            .then(data => {
                if (data.number === "Queue is empty") {
                    alert("Queue is empty!");
                } else {
                    const generatedNumber = data.number; // Get the generated number
                    localStorage.setItem('assessmentNumber', generatedNumber); // Store the number
                    localStorage.setItem('assessmentDepartment', 'Assessment'); // Store the department
                    assessmentButton.setAttribute("data-number", parseInt(generatedNumber) + 1);
                    printNumber(generatedNumber);
                    sendDataToServer(generatedNumber, 'Assessment');
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });

    // Similar modifications for cashierButton and registrarButton

    cashierButton.addEventListener("click", function () {
        fetch(`generate.php?number=${cashierButton.getAttribute("data-number") || 1}`)
            .then(response => response.json())
            .then(data => {
                if (data.number === "Queue is empty") {
                    alert("Queue is empty!");
                } else {
                    const generatedNumber = data.number; // Get the generated number
                    localStorage.setItem('cashierNumber', generatedNumber); // Store the number
                    localStorage.setItem('cashierDepartment', 'Cashier'); // Store the department
                    cashierButton.setAttribute("data-number", parseInt(generatedNumber) + 1);
                    printNumbercashier(generatedNumber);
                    sendDataToServer(generatedNumber, 'Cashier');
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });

    registrarButton.addEventListener("click", function () {
        fetch(`generate.php?number=${registrarButton.getAttribute("data-number") || 1}`)
            .then(response => response.json())
            .then(data => {
                if (data.number === "Queue is empty") {
                    alert("Queue is empty!");
                } else {
                    const generatedNumber = data.number; // Get the generated number
                    localStorage.setItem('registrarNumber', generatedNumber); // Store the number
                    localStorage.setItem('registrarDepartment', 'Registrar'); // Store the department
                    registrarButton.setAttribute("data-number", parseInt(generatedNumber) + 1);
                    printNumberRegistrar(generatedNumber);
                    sendDataToServer(generatedNumber, 'Registrar');
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
    
    // FOR ASSESSMENT PRINT FORMAT
    function printNumber(number) {
        // Create a hidden iframe and load the number into it for printing
        const iframe = document.createElement("iframe");
        iframe.style.display = "none";
        document.body.appendChild(iframe);
    
        // Get the current date and time in the Philippines timezone
        const currentDate = new Date();
        const options = {
            year: 'numeric',
            month: 'long', // Full month name (e.g., "January")
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true, // Use 12-hour format
            timeZone: 'Asia/Manila' // Set to the Philippines timezone
        };
        const formattedDate = currentDate.toLocaleDateString('en-PH', options);
    
        // Construct an HTML document with the number, date, and set the paper size
        const content = `
        <!DOCTYPE html>
            <html>
                <head>
                    <style>
                        
                        @page {
                            size: 50mm 45mm;
                            margin: 0;
                        }
                        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');
                        body {
                            font-family: 'Oswald', sans-serif;
                            margin: 0;
                            size: 50mm 45mm;
                            text-align: center;
                            height: 45mm;
                            padding: 5;
                            page-break-after: always;
                        }
                        h3 {
                            font-size: 20px;
                            font-weight: bold;
                        }
                        h1 {
                            font-size: 90px;
                            margin-top: -10mm;
                            margin-bottom: -5mm;
                            font-weight: bold;
                        }
                        .dwcl {
                            font-size: 11px;
                            margin-bottom: 5mm;
                            font-weight: bold;
                        }
                        .time {
                            font-size: 10px;
                            font-weight: bold;
                        }
                    </style>
                </head>
                <body>
                    <h3>ASSESSMENT</h3> <!-- Updated to 'Registrar' -->
                    <h1>${number}</h1>
                    <p class='dwcl'>Divine Word College of Legazpi</p>
                    <p class='time'>${formattedDate}</p>
                </body>
            </html>
        `;
    
        iframe.contentDocument.write(content);
        iframe.contentDocument.close();
    
        // Disable print dialog and print the iframe content
        iframe.contentWindow.print();
    
        // Remove the iframe after printing
        iframe.parentNode.removeChild(iframe);
    }
    

// FOR Cashier PRINT format 

    function printNumbercashier(number) {
    // Create a hidden iframe and load the number into it for printing
    const cashieriframe = document.createElement("iframe");
    cashieriframe.style.display = "none";
    document.body.appendChild(cashieriframe);

    // Get the current date and time in the Philippines timezone
    const currentDate = new Date();
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
        timeZone: 'Asia/Manila'
    };
    const formattedDate = currentDate.toLocaleDateString('en-PH', options);

    // Construct an HTML document with the number, date, and set the paper size
    const content = `
        <!DOCTYPE html>
        <html>
        <head>
            <style>                  
                @page {
                    size: 50mm 45mm;
                    margin: 0;
                }
                @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');
                body {
                    font-family: 'Oswald', sans-serif;
                    margin: 0;
                    size: 50mm 45mm;
                    text-align: center;
                    height: 45mm;
                    padding: 5;
                    page-break-after: always;
                }
                h3 {
                    font-size: 20px;
                    font-weight: bold;
                }
                h1 {
                    font-size: 90px;
                    margin-top: -10mm;
                    margin-bottom: -5mm;
                    font-weight: bold;
                }
                .dwcl {
                    font-size: 11px;
                    margin-bottom: 5mm;
                    font-weight: bold;
                }
                .time {
                    font-size: 10px;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <h3>CASHIER</h3> <!-- Updated to 'Registrar' -->
            <h1>${number}</h1>
            <p class='dwcl'>Divine Word College of Legazpi</p>
            <p class='time'>${formattedDate}</p>
        </body>
        </html>
    `;

    // Write the content to the iframe and print
    cashieriframe.contentDocument.open();
    cashieriframe.contentDocument.write(content);
    cashieriframe.contentDocument.close();

    // Disable print dialog and print the iframe content
    cashieriframe.contentWindow.print();

    // Remove the iframe after printing
    document.body.removeChild(cashieriframe);
}

    
    // FOR REGISTRAR PRINT FORMAT
        
    function printNumberRegistrar(number) {
        // Create a hidden iframe and load the number into it for printing
        const registrariframe = document.createElement("iframe");
        registrariframe.style.display = "none";
        document.body.appendChild(registrariframe);

        // Get the current date and time in the Philippines timezone
        const currentDate = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true,
            timeZone: 'Asia/Manila'
        };
        const formattedDate = currentDate.toLocaleDateString('en-PH', options);

        // Construct an HTML document with the number, date, and set the paper size
        const content = `
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    @page {
                        size: 50mm 45mm;
                        margin: 0;
                    }
                    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');
                    body {
                        font-family: 'Oswald', sans-serif;
                        margin: 0;
                        size: 50mm 45mm;
                        text-align: center;
                        height: 45mm;
                        padding: 5;
                        page-break-after: always;
                    }
                    h3 {
                        font-size: 20px;
                        font-weight: bold;
                    }
                    h1 {
                        font-size: 90px;
                        margin-top: -10mm;
                        margin-bottom: -5mm;
                        font-weight: bold;
                    }
                    .dwcl {
                        font-size: 11px;
                        margin-bottom: 5mm;
                        font-weight: bold;
                    }
                    .time {
                        font-size: 10px;
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <h3>REGISTRAR</h3> <!-- Updated to 'Registrar' -->
                <h1>${number}</h1>
                <p class='dwcl'>Divine Word College of Legazpi</p>
                <p class='time'>${formattedDate}</p>
            </body>
            </html>
        `;

        // Write the content to the iframe and print
        registrariframe.contentDocument.open();
        registrariframe.contentDocument.write(content);
        registrariframe.contentDocument.close();

        // Disable print dialog and print the iframe content
        registrariframe.contentWindow.print();

        // Remove the iframe after printing
        document.body.removeChild(registrariframe);
    }

    
});

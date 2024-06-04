<?php
    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:saheli-digital-server.database.windows.net,1433; Database = saheliData", "azure", "Saheli@111");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "azure", "pwd" => "Saheli@111", "Database" => "saheliData", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:saheli-digital-server.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    // Assuming $_POST['YName'], $_POST['YNumber'], $_POST['YEmail'], $_POST['YDate'] contain the input data
    $YName = $_POST['YName'];
    $YNumber = $_POST['YNumber'];
    $YEmail = $_POST['YEmail'];
    $YDate = $_POST['YDate'];

    // Check if any of the input values are empty
    if (empty($YName) || empty($YNumber) || empty($YEmail) || empty($YDate)) {
        echo '<style>
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .modal-content {
            background-color: #f3f3f3;
            color: #FA040F;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(247,3,3,0.7);
            padding: 30px;
            transition: background-color 0.3s, color 0.3s;
            text-align: center;
        }
        .modal-content:hover {
            background-color: #1FA040F;
            color: #f3f3f3;
        }
        .go-back-button {
            background-color: #FA040F;
            color: #f3f3f3;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
        }
        .go-back-button:hover {
            background-color: #f3f3f3;
            color: #FA040F;
        }
        </style>';

        echo '<script type="text/javascript">
            window.onload = function() {
                var modalContainer = document.createElement("div");
                modalContainer.className = "modal-container";
                var modalContent = document.createElement("div");
                modalContent.className = "modal-content";
                modalContent.innerHTML = "<p style=\'font-size: 20px;\'>Booking Unsuccessful</p>";
                var goBackButton = document.createElement("button");
                goBackButton.innerHTML = "Go Back";
                goBackButton.className = "go-back-button";
                goBackButton.addEventListener("click", function() {
                    window.location.href = "index.php#book"; // Replace with your desired URL
                });
                modalContent.appendChild(goBackButton);
                modalContainer.appendChild(modalContent);
                document.body.appendChild(modalContainer);
            }
            </script>';
    } else {
        // SQL query
        $sql = "INSERT INTO appointment (YName, YNumber, YEmail, YDate) 
                VALUES (?, ?, ?, ?)";

        // Prepare and execute statement
        $params = array($YName, $YNumber, $YEmail, $YDate);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            echo '<style>
            .modal-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }
            .modal-content {
                background-color: #f3f3f3;
                color: #16a085;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(22, 160, 133, 0.7);
                padding: 30px;
                transition: background-color 0.3s, color 0.3s;
                text-align: center;
            }
            .modal-content:hover {
                background-color: #16a085;
                color: #f3f3f3;
            }
            .go-back-button {
                background-color: #16a085;
                color: #f3f3f3;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
                margin-top: 20px;
            }
            .go-back-button:hover {
                background-color: #f3f3f3;
                color: #16a085;
            }
            </style>';

            echo '<script type="text/javascript">
                window.onload = function() {
                    var modalContainer = document.createElement("div");
                    modalContainer.className = "modal-container";
                    var modalContent = document.createElement("div");
                    modalContent.className = "modal-content";
                    modalContent.innerHTML = "<p style=\'font-size: 20px;\'>Booking Successful</p>";
                    var goBackButton = document.createElement("button");
                    goBackButton.innerHTML = "Go Back";
                    goBackButton.className = "go-back-button";
                    goBackButton.addEventListener("click", function() {
                        window.location.href = "index.php"; // Replace with your desired URL
                    });
                    modalContent.appendChild(goBackButton);
                    modalContainer.appendChild(modalContent);
                    document.body.appendChild(modalContainer);
                }
                </script>';
        }
    }

    // Close the connection
    sqlsrv_close($conn);
?>

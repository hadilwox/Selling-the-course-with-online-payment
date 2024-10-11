<?php
global $db;
require "../source/db.php";
session_start();
if(isset($_POST["buyCourse"])){
    echo "Yes";

    if (isset($_SESSION["nameCourse"])){
        echo "Yes2";

        $nameCourse = $_SESSION["nameCourse"];
        $priceCourse = $_SESSION["priceCourse"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $address = $_POST["address"];
        $postCode = $_POST["postCode"];
        $phone  = $_POST["phone"];
        $email  = $_POST["email"];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://gateway.zibal.ir/v1/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
      "merchant": "zibal",
        "amount" : "'.$priceCourse.'",
        "callbackUrl" : "http://localhost/link-php/pages/verifyBuy.php",
        "description" : "'.$nameCourse.'",
        "mobile" : "'.$phone.'"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        var_dump($response);
        $resOBJ = (array) json_decode($response);
//        echo $resOBJ["result"];

        if ($resOBJ["result"] == 100){

            $trackId = $resOBJ["trackId"];

            if ($trackId){
                $sql = "INSERT INTO users SET firstName = '$firstName' , lastName = '$lastName' , phone = '$phone' , address = '$address' , codePost = '$postCode' , email = '$email' ";
                $result = $db->prepare($sql);
                $result->execute();
//                echo "پرداخت با موفقیت انجام شد";

                header("Location:https://gateway.zibal.ir/start/".$trackId);
            }

        } else {
            echo "پرداخت انجام نشد !";
        }


    }
}
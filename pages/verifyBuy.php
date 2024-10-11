<?php
global $db;
require_once "../source/db.php";

if (isset($_GET["success"])) {
    $success = $_GET["success"];
    $status = $_GET["status"];
    $trackId = $_GET["trackId"];

    $message = null;
    $headerLoc = null;

    if ($success == 1) {


        $message = "تراکنش با موفقیت انجام شد";
        $headerLoc = "Location: /link-php/pages/singleProduct.php?msg=" . $message;
        $_SESSION["buy"] = true;
        $isBuy = $_SESSION["buy"];

    } else {
        $_SESSION["buy"] = false;
        $isBuy = $_SESSION["buy"];
        switch ($status) {
            case -2:
                $message = "خطای داخلی";
                break;
            case -1:
                $message = "در انتظار پردخت";
                break;
            case 1:
                $message = "پرداخت شده - تاییدشده";
                break;
            case 2:
                $message = "پرداخت شده - تاییدنشده";
                break;
            case 3:
                $message = "لغوشده توسط کاربر";
                break;
            case 4:
                $message = "‌شماره کارت نامعتبر می‌باشد.";
                break;
            case 5:
                $message = "‌موجودی حساب کافی نمی‌باشد.";
                break;
            case 6:
                $message = "رمز واردشده اشتباه می‌باشد.";
                break;
            case 7:
                $message = "‌تعداد درخواست‌ها بیش از حد مجاز می‌باشد.";
                break;
            case 8:
                $message = "‌تعداد پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد.";
                break;
            case 9:
                $message = "مبلغ پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد.";
                break;
            case 10:
                $message = "صادرکننده‌ی کارت نامعتبر می‌باشد.";
                break;
            case 11:
                $message = "خطای سوییچ";
                break;
            case 12:
                $message = "کارت قابل دسترسی نمی‌باشد.";
                break;
        }
    }

    ?>

    <?php require "../layout/header.php"; ?>
    <title>پاسخ پرداخت</title>
    </head>

    <body class="container mx-auto flex flex-col bg-gray-900">
        <h1 class="mx-auto text-2xl font-bold text-gray-50 mt-10">
            <?= $message ?>
        </h1>
        <div>
            <?php if ($isBuy == true): ?>
                <a href="singleProduct.php?msg=<?= $message ?>">
                    <p class="my-4 bg-green-500 text-white text-2xl mx-auto w-fit py-3 px-4 rounded-md">
                        برای دیدن دوره کلیک کنید
                    </p>
                </a>
            <?php endif; ?>
        </div>
        <br />
    </body>
    <?php
}

<?php
session_start();
global $db;
require "../source/db.php";

if (isset($_SESSION["buy"]) && $_SESSION["buy"] == true){
    $courseName = $_SESSION["nameCourse"];
    $query = "SELECT * FROM courses , uploads WHERE name_c = '$courseName' AND courses.image_id = uploads.id";
    $result = $db->query($query);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_OBJ);
    $isBuy = true;
} else if (isset($_GET['course'])) {
    $courseName  = $_GET['course'];
    $query = "SELECT * FROM courses , uploads WHERE name_c = '$courseName' AND courses.image_id = uploads.id";
    $result = $db->query($query);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_OBJ);
    $isBuy = false;


}
?>
<?php require "../layout/header.php"; ?>

<title><?= $courseName ?></title>
</head>
<body class="container mx-auto flex flex-col bg-gray-900">
<h1 class="mx-auto text-2xl font-bold text-gray-50 my-10"><?= $courseName ?></h1>

<section class="flex flex-row gap-x-5 max-w-screen-md mx-auto">

<?php foreach ($data as $item) : ?>



    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-20">

            <img class="rounded-[3.5rem] p-6" src="../uploads/<?= $item->name ?>" alt="<?= $item->name_c ?>" />

        <div class="p-5 text-center">

            <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $item->name_c ?></h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 leading-8 text-justify	"><?= $item->description ?></p>

            <?php if ($isBuy) { ?>

                <a href="#" class="inline-flex items-center px-3 py-2 text-lg font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                   مشاهده دوره
                </a>

            <?php } else { ?>

            <a href="buyPage.php?buy=<?= $item->name_c ?>" class="inline-flex items-center px-3 py-2 text-lg font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                 <?= number_format($item->price / 10) ?> تومان
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-5 h-5 ms-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

            </a>

            <?php } ?>

        </div>
    </div>


<?php endforeach; ?>
</section>
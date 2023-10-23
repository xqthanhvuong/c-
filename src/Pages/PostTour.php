<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/web-tour/src/Image/logo.png" type="image/png">
    <title>Thêm tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #uploadExcel::-webkit-file-upload-button {
            visibility: hidden;
        }
    </style>
</head>
<?php include "../Components/Header/Header.php" ?>

<body>
    <h1 class="text-3xl text-sky-500 text-center font-bold mt-8  uppercase">Post tour with excel file</h1>
    <div class="relative mx-96">
        <a href="./PostTourWithForm.php"><label class="absolute right-0 top-1 cursor-pointer text-sky-500 hover:underline hover:text-sky-1000">Or Insert tours with form</label></a>
    </div>
    <div class="flex justify-center h-96 items-center ">
        <div class="w-1/2 h-56 border border-dashed border-black rounded  relative" id="box-excel">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                <img src="../Image/upload.svg" alt="upload" class="w-8 align-middle">
                <label for="uploadExcel" class="text-lg text-center tracking-widest">Click or drop file excel here
                </label>
                <span class="text-sm" style="line-height: 13px; letter-spacing: 1px;">(.xlsx, .xls, .csv)</span>
            </div>
            <input type="file" id="uploadExcel" accept=".xlsx, .xls, .csv" class="opacity-0 w-full h-full absolute absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer" />
        </div>
    </div>
    <script src='../Lib/jszip.js'></script>
    <script src="../Lib/xlsx.js"></script>
    <script src="../js/postTour.js"></script>
</body>
<?php include "../Components/Footer/Footer.php" ?>


</html>
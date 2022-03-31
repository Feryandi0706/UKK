<?php
    require "../login/security.php";
    require '../koneksi.php';
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profile Page</title>
</head>

<body>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-800">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="../home/home.php" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Tweets</span>
            </a>
            <div class="flex md:order-2">

                <div class="relative group">
                    <button type="button" class="group relative flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700">
                        <?= $username ?>
                        <span class="material-icons">
                            keyboard_arrow_down
                        </span>
                    </button>

                    <div class="items-center absolute px-5 py-0 invisible group-hover:visible w-auto">
                        <a href="../profile/profilePage.php" class="px-4 py-2 rounded block text-black bg-white">Profile</a>
                        <a href="../login/logout.php" class="bg-red-500 px-4 py-2 rounded block text-white">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <section>
        <div class="mt-20">
            <form class="block mx-auto p-6 w-80 bg-white rounded-lg border border-gray-200 shadow-md" method="POST" action="saveProfile.php">
                <?php
                    $sqlGetDataProfile = "select * from users where email='$email'";
                    $queryGetDataProfile = mysqli_query($con, $sqlGetDataProfile);
                    $resultDataProfile = mysqli_fetch_array($queryGetDataProfile);
                    $bio = $resultDataProfile['bio'];
                    $foto = $resultDataProfile['foto'];
                    if($foto == "") {
                        $fotoAvatar = "avatar.png";
                    }
                    else {
                        $fotoAvatar = $foto;
                    }
                ?>
                <div class="flex items-center flex-col">
                    <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="../img/<?= $fotoAvatar ?>" alt="Avatar"/>
                    <input type="hidden" name="foto_avatar" value="<?= $fotoAvatar ?>">
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="hidden" name="email" id="email" value="<?= $email ?>">
                    <textarea type="bio" name="bio" rows="3" class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " autocomplete="off" id="bio"><?= $bio ?></textarea>
                    <label for="bio" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Bio</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <div class="flex justify-center">
                        <div class="mb-3 w-96">
                            <label for="foto" class="form-label inline-block mb-2 text-gray-700">Choose Your Picture</label>
                            <input class="form-control file:rounded-full file:border-none file:bg-yellow-300 file:px-3 file:py-2 outline-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding focus:border-blue-600 focus:outline-none" value="<?= $foto ?>" type="file" id="foto" name="foto">
                        </div>
                    </div>
                </div>
                <button type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </form>
        </div>

    </section>
</body>

</html>
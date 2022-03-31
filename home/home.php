<?php
require "../login/security.php";
require "../koneksi.php";
$usernameSession = $_SESSION['username'];
$emailSession = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>
</head>

<style>
    .modals,
    .modalsKomen {
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .show {
        display: block;
    }
</style>

<body>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-800">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="home.php" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Tweets</span>
            </a>
            <div class="flex md:order-2">
                <div class="hidden relative mr-3 md:mr-0 md:block">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput" class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." onchange="searchFunction()">
                </div>
            </div>
            <div class="flex md:order-2">
                <div class="relative group">
                    <button type="button" class="group relative flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700">
                        <?= $usernameSession ?>
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


    <section id="main-content">
        <div class="title py-3 ml-5 border-0 border-b-2 border-sky-600 w-fit">
            <div class="">
                <h1 class="text-4xl font-bold">Postingan</h1>
            </div>
        </div>
        <button class="bg-amber-300 w-14 h-14 rounded-full fixed bottom-10 right-10 flex justify-center items-center" id="showModals">
            <p class="font-extrabold text-3xl text-white -mt-1">+</p>
        </button>

        <div class="postingan m-5 grid grid-cols-4 gap-4">
            <?php
            $sqlShowPostingan = "SELECT tweets.*, users.username FROM tweets left join users on tweets.email = users.email";
            $queryShowPostingan = mysqli_query($con, $sqlShowPostingan);
            while ($resultShowPostingan = mysqli_fetch_array($queryShowPostingan)) {
                $id_tweets = $resultShowPostingan['id_tweets'];
                $username = $resultShowPostingan['username'];
                $email = $resultShowPostingan['email'];
                $text_hastag = $resultShowPostingan['text_hastag'];
                $file = $resultShowPostingan['file'];
                if ($file == "") {
                    $file = "logo-nav.png";
                }
            ?>


                <div class="hidden max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-end px-4 py-4">
                        <div class="flex flex-rows text-gray-500 dark:text-gray-400 rounded-lg text-sm p-1.5">
                            <a onclick="showModalsEdit(`<?= $text_hastag; ?>`,`<?= $id_tweets; ?>`)">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                            <a href="deleteFunction.php?id=<?= $id_tweets ?>">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </a>
                            <a onclick="showModalAddKomentar(`<?= $id_tweets; ?>`)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                    <div class="flex flex-col items-center pb-10">
                        <img class="mb-3 w-60 h-16 rounded-md border border-white shadow-lg" src="../img/<?= $file ?>">

                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?= $username ?></h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400"><?= $text_hastag ?>
                            <?php
                                $sqlTag = "select * from tags where id_tweets='$id_tweets'";
                                $queryTag = mysqli_query($con, $sqlTag);
                                while ($resultTag = mysqli_fetch_array($queryTag)) {
                                    echo "#" . $resultTag['tags'] . " ";
                                }
                            ?>
                        </span>
                    </div>

                    <div class="flex flex-col items-center pb-10">
                        <?php
                        $sqlKomentar = "select * from comments where id_tweets='$id_tweets'";
                        $queryKomentar = mysqli_query($con, $sqlKomentar);
                        while ($resutlKomentar = mysqli_fetch_array($queryKomentar)) {
                            $komentar = $resutlKomentar['comments'];
                            $id_comment = $resutlKomentar['id_comments'];
                        ?>
                            <div class="bg-gray-700 mb-2 rounded-md flex items-center px-3 py-1">
                                <input type="text" id="inputKomentar<?= $id_comment ?>" value="<?= $komentar ?>" class="bg-transparent text-white" disabled>
                                <a onclick="editKomentar(`<?= $id_comment ?>`, `<?= $komentar ?>`)">
                                    <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>
                                <a href="deleteKomentar.php?id_comments=<?= $id_comment ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M6.707 4.879A3 3 0 018.828 4H15a3 3 0 013 3v6a3 3 0 01-3 3H8.828a3 3 0 01-2.12-.879l-4.415-4.414a1 1 0 010-1.414l4.414-4.414zm4 2.414a1 1 0 00-1.414 1.414L10.586 10l-1.293 1.293a1 1 0 101.414 1.414L12 11.414l1.293 1.293a1 1 0 001.414-1.414L13.414 10l1.293-1.293a1 1 0 00-1.414-1.414L12 8.586l-1.293-1.293z" clipRule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="hidden flex justify-around" id="btnActionKomentar">
                            <button class="px-4 py-2 mr-2 rounded-md text-white bg-green-700" id="btnSaveKomentar">Save Komentar</button>
                            <button class="px-4 py-2 rounded-md text-white bg-red-700" id="btnCancelKomentar">Cancel</button>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>



        <div class="modals hidden" id="modals">
            <div id="authentication-modal" tabindex="-1" class="w-full justify-center items-center">
                <div class="relative mx-auto p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex justify-end p-2">
                            <button type="button" id="closeBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <form class="px-6 pb-4 space-y-6 lg:px-8 pb-12" action="uploadFunction.php" method="GET">
                            <input type="hidden" name="email" value="<?= $emailSession ?>">
                            <input type="hidden" name="id_tweets" id="id_tweets">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">Postingan</h3>
                            <div>
                                <label for="text_hastag" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Content & Hastag</label>
                                <textarea type="text" maxlength="250" name="text_hastag" id="text_hastag" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required=""></textarea>
                            </div>
                            <div>
                                <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Add files</label>
                                <input type="file" name="file" id="file" class="form-control file:border-none file:bg-gray-700 file:text-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white mb-3">
                            </div>

                            <button type="submit" name="action" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="action" value="save">Upload Postingan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modalsKomen hidden" id="modalsKomen">
            <div id="authentication-modal" tabindex="-1" class="w-full justify-center items-center">
                <div class="relative mx-auto p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex justify-end p-2">
                            <button type="button" id="closeBtnKomen" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <form class="px-6 pb-4 space-y-6 lg:px-8 pb-12" action="uploadKomentar.php" method="GET">
                            <input type="hidden" name="id_comments" id="id_comments">
                            <input type="hidden" name="id_tweets_comments" id="id_tweets_comments">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">Komentar</h3>
                            <div>
                                <label for="comments" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Komentar</label>
                                <textarea type="text" name="comments" id="comments" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required=""></textarea>
                            </div>

                            <button type="submit" name="action" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="action_komen" value="save">Update Komentar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="data"></div>

    <script>
        // Function buat show modals add postingan
        let modals = document.getElementById('modals');
        let btnModals = document.getElementById('showModals');
        let closeBtn = document.getElementById('closeBtn');

        btnModals.onclick = function() {
            modals.style.display = 'block';
        }
        closeBtn.onclick = function() {
            modals.style.display = 'none';
        }

        // Function buat show modals edit postingan dan show data yang ingin di eddit
        function showModalsEdit(text_hastag, id_tweets) {
            let modals = document.getElementById('modals');
            let btnModals = document.getElementById('showModals');
            let closeBtn = document.getElementById('closeBtn');
            modals.style.display = 'block';
            closeBtn.onclick = function() {
                modals.style.display = 'none';
            }
            let actionBtn = document.getElementById('action').value = "edit";
            document.getElementById('text_hastag').innerHTML = text_hastag;
            document.getElementById('id_tweets').value = id_tweets;
        }

        // FUnction buat edit komentar yang telat di upload
        function editKomentar(id, komentar) {
            let modals = document.getElementById('modalsKomen');
            modals.style.display = 'block';
            let closeBtnKomen = document.getElementById('closeBtnKomen');
            closeBtnKomen.onclick = function() {
                modals.style.display = 'none';
            }
            document.getElementById('id_comments').value = id;
            document.getElementById('comments').innerHTML = komentar;
            document.getElementById('action_komen').value = "edit";
        }

        // Function show modal buat menambahkan Komentar
        function showModalAddKomentar(id) {
            let modals = document.getElementById('modalsKomen');
            modals.style.display = 'block';
            document.getElementById('id_tweets_comments').value = id;
        }

    </script>


</body>

</html>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	  <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <title>Login</title>
</head>
<body>
    <section class="gradient-form h-full w-full justify-center items-center mt-32 lg:mt-16 dark:bg-neutral-700">
        <div class="container h-full p-10">
          <div
            class="flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
            <div class="w-full">
              <div
                class="rounded-lg bg-white shadow-lg dark:bg-neutral-800">
                <div class="g-0 md:mt-0 mt-12 lg:flex lg:flex-wrap">
                  <!-- Left column container-->
                  <div class="px-4 md:px-0 lg:w-6/12">
                    <div class="md:mx-6 px-2 py-8 md:p-12">
                
                    <form id="aform" method="post" class="max-w-md mx-auto">
                      <div id="resp"></div>
                      <p class="flex items-center justify-center text-2xl text-orange-500 font-extrabold">Admin Login</p>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-orange-500 focus:outline-none focus:ring-0 focus:border-orange-600 peer" placeholder=" " required />
                            <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-orange-600 peer-focus:dark:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-orange-500 focus:outline-none focus:ring-0 focus:border-orange-600 peer" placeholder=" " required />
                            <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-orange-600 peer-focus:dark:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                        </div>
                        <button type="submit" class="text-white bg-orange-500 hover:bg-red-500 hover:text-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full :w-auto px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                          <div class="w-full flex  items-center justify-center">
                          <span class="mr-2">
                            Log in
                          </span>
                          <div id="log"></div>							
                        </div>
                        </button>
                      <div class="flex w-full justify-center">
                      </div>
                    </form>
                    </div>
                  </div>
      
                  <!-- Right column container with background and description-->
                  <div
                    class="hidden lg:block items-center mt-6 rounded-b-lg  lg:w-6/12 lg:rounded-e-lg lg:rounded-bl-none"
                    style="background: linear-gradient(to right, rgb(253 186 116), rgb(249, 22, 22), rgb(234 88 12), rgb(194, 12, 12))">
                    <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                      <div class=" text-center">
                        <img
                          class="mx-auto w-48"
                          src="../assets/logo.png"
                          alt="logo" />
                        <h4 class="mb- mt-1 pb-1 text-xl font-semibold">
                          Welcome to Halal Restaurantz
                        </h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  <script>
		$(document).ready(function() {


			// submit registeration
			$("#aform").submit(function(e) {
				e.preventDefault();

				$("#resp").html("");

				$("#log").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");

				var formData = new FormData(this);

				$.ajax({
					
					url: 'log.php',
					type: 'POST',
					data: formData,
					success: function(data) {
						if (data == 'success') {
						
							$("#resp").html("<div class='w-full flex justify-center text-center'> <div class='mb-3 inline-flex w-full items-center rounded-lg bg-green-100 p-4 text-base text-green-700' role='alert'> <span class='mr-2'> <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='h-5 w-5'> <path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z' clip-rule='evenodd' /> </svg> </span> Login Successful </div> </div>");
							$("#log").html("");

							setTimeout(function() {
								window.location.href = "dashboard.php";
							}, 2000);
						} else {
							$("#resp").html(data);
							$("#log").html("");
						}
						// $("#aform")[0].reset();
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});

		});
	</script>
</body>
</html>

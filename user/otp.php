<?php
include "../config.php";
session_start();
if (!isset($_SESSION['loggedin_restaurant'])) {
    header("location:./");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Verify OTP</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="relative font-inter antialiased">

    <main class="relative min-h-screen flex flex-col justify-center bg-slate-50 overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-24">
            <div class="flex justify-center">

                <div class="max-w-md mx-auto text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
                    <div id="resp2"></div>
                    <div id="resp"></div>
                    <header class="mb-8">
                        <h1 class="text-2xl font-bold mb-1">Email Verification</h1>
                        <p class="text-[15px] text-slate-500">Enter the 4-digit verification code that was sent to your email.</p>
                    </header>
                    <form id="otp-form" method="post">
                        <div class="flex items-center justify-center gap-3">
                            <input
                                type="text" name="otp1"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                                pattern="\d*" maxlength="1" />
                            <input
                                type="text" name="otp2"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                                maxlength="1" />
                            <input
                                type="text" name="otp3"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                                maxlength="1" />
                            <input
                                type="text" name="otp4"
                                class="w-14 h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                                maxlength="1" />
                        </div>
                        <div class="max-w-[260px] mx-auto mt-4">
                            <button type="submit"
                                class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-orange-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-orange-950/10 hover:bg-orange-600 focus:outline-none focus:ring focus:ring-orange-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-orange-300 transition-colors duration-150">
                                <span class="mr-2">
                                    Verify Otp
                                </span>
                                <div id="log"></div>
                            </button>
                        </div>
                    </form>
                    <div class="text-sm text-slate-500 mt-4">Didn't receive code? <button data-id=<?php echo $_SESSION['loggedin_restaurant']; ?> class="resend-otp font-medium text-orange-500 hover:text-orange-600">Resend</button></div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const form = document.getElementById('otp-form')
                        const inputs = [...form.querySelectorAll('input[type=text]')]
                        const submit = form.querySelector('button[type=submit]')

                        const handleKeyDown = (e) => {
                            if (
                                !/^[0-9]{1}$/.test(e.key) &&
                                e.key !== 'Backspace' &&
                                e.key !== 'Delete' &&
                                e.key !== 'Tab' &&
                                !e.metaKey
                            ) {
                                e.preventDefault()
                            }

                            if (e.key === 'Delete' || e.key === 'Backspace') {
                                const index = inputs.indexOf(e.target);
                                if (index > 0) {
                                    inputs[index - 1].value = '';
                                    inputs[index - 1].focus();
                                }
                            }
                        }

                        const handleInput = (e) => {
                            const {
                                target
                            } = e
                            const index = inputs.indexOf(target)
                            if (target.value) {
                                if (index < inputs.length - 1) {
                                    inputs[index + 1].focus()
                                } else {
                                    submit.focus()
                                }
                            }
                        }

                        const handleFocus = (e) => {
                            e.target.select()
                        }

                        const handlePaste = (e) => {
                            e.preventDefault()
                            const text = e.clipboardData.getData('text')
                            if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                                return
                            }
                            const digits = text.split('')
                            inputs.forEach((input, index) => input.value = digits[index])
                            submit.focus()
                        }

                        inputs.forEach((input) => {
                            input.addEventListener('input', handleInput)
                            input.addEventListener('keydown', handleKeyDown)
                            input.addEventListener('focus', handleFocus)
                            input.addEventListener('paste', handlePaste)
                        })
                    })
                </script>

            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {


            // submit registeration
            $("#otp-form").submit(function(e) {
                e.preventDefault();

                $("#resp").html("");

                $("#log").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");

                var formData = new FormData(this);

                $.ajax({

                    url: 'verifyOtp.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        if (data == 'success') {

                            $("#resp").html("<div class='w-full flex justify-center text-center'> <div class='mb-3 inline-flex w-full items-center rounded-lg bg-green-100 p-4 text-base text-green-700' role='alert'> <span class='mr-2'> <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='h-5 w-5'> <path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z' clip-rule='evenodd' /> </svg> </span> Login Successful </div> </div>");
                            $("#resp2").html("");
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

            $('.resend-otp').click(function() {
                var email = $(this).data('id');

                $("#resp2").html("");
                $("#log").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");

                $.ajax({
                    url: 'resend_otp.php', // URL to the server-side script
                    type: 'POST',
                    data: {
                        email: email
                    }, // Sending email from session
                    success: function(data) {
                        // Handle success data
                        if (data == 'success') {
                            $("#resp2").html("<div class='w-full flex justify-center text-center'> <div class='mb-3 inline-flex w-full items-center rounded-lg bg-green-100 p-4 text-base text-green-700' role='alert'> <span class='mr-2'> <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='h-5 w-5'> <path fill-rule='evenodd' d='M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z' clip-rule='evenodd' /> </svg> </span> Otp has been resent to your email </div> </div>");
                            $("#log").html("");
                        } else {
                            $("#resp2").html(data);
                            $("#log").html("");
                        }
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
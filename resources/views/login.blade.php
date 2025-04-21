<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Hotel Hebat</title>
</head>

<body style="background-image: url('/img/image2.jpg');" class="bg-cover bg-center h-screen">
    <div class="col flex justify-center items-center h-screen ">
        <div class="nav m-8 bg-white rounded-sm w-1/3 flex justify-center items-center flex-col border-2 border-blue-700">
            <div class="div m-8 w-1/2">
                <div class="nav flex justify-center text-3xl text-black m-4 m">
                    <p>Login</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="my-4 text-2xl">
                        <label for="name"> Username </label>
                        <input type="text" name="name" placeholder="Username" class="border rounded-sm my-2">
                    </div>
                    <div class="my-4 text-2xl">
                        <label for="password"> Password </label>
                        <input type="password" name="password" placeholder="Password" class="border rounded-sm my-2">
                    </div>
                    <div class="flex justify-center m-4 text-2xl">
                        <button type="submit" class="bg-[#06402B] px-2 py-1 rounded-sm font-normal text-white">Login</button>
                    </div>
                </form>
                <div class="flex justify-center">
                    <h6>Atau <a href="register" class="decoration-sky-500 font-light">Registrasi</a></h6>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="assets/images/favicon.png">
		<title>Vestrado Loyalty Store</title>
		<script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* From Uiverse.io by WhiteNervosa */
.slider {
  background-color: #ffffff2b;
  border-radius: 100px;
  padding: 1px;
  margin: 10px;
  cursor: pointer;
  transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1) 0s;
  align-items: center;
  position: relative;
  display: block;
  width: 40px;
  height: 20px;
  box-shadow: rgba(0, 0, 0, 0.62) 0px 0px 5px inset, rgba(0, 0, 0, 0.21) 0px 0px 0px 24px inset,
        #22cc3f 0px 0px 0px 0px inset, rgba(224, 224, 224, 0.45) 0px 1px 0px 0px;
}

.slider::after {
  content: "";
  display: flex;
  top: 2.3px;
  left: 2px;
  width: 15px;
  height: 15px;
  background-color: #e3e3e3;
  border-radius: 200px;
  position: absolute;
  box-shadow: transparent 0px 0px 0px 2px, rgba(0, 0, 0, 0.3) 0px 6px 6px;
  transition: left 300ms cubic-bezier(0.4, 0, 0.2, 1) 0s, background-color 300ms cubic-bezier(0.4, 0, 0.2, 1) 0s;
  will-change: left, background-color;
}

.switch input[type="checkbox"]:checked + .slider {
  box-shadow: rgba(0, 0, 0, 0.62) 0px 0px 5px inset, #22cc3f 0px 0px 0px 2px inset, #22cc3f 0px 0px 0px 24px inset,
        rgba(224, 224, 224, 0.45) 0px 1px 0px 0px;
}

.switch input[type="checkbox"]:checked + .slider::after {
  left: 24px;
}

.switch input[type="checkbox"] {
  display: none;
}
    </style>
  </head>
  <body class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen flex flex-col">
      <header class="flex items-center justify-between bg-white p-4 shadow">
        <div class="flex items-center space-x-2">

          <span class="text-xl font-bold">Loyalty Store</span>
        </div>
        <div class="hidden lg:block w-1/3">
          <input
            type="text"
            class="w-full border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-green-300"
            placeholder="Find something here..." />
        </div>
        @if(isset($islogin) && $islogin)
            <div class="flex items-center space-x-4">
                <button class="text-sm font-medium hover:text-green-700">
                    Client Panel
                </button>
                <div class="flex items-center space-x-2">
                    <img
                        class="w-8 h-8 rounded-full object-cover"
                        src="assets/images/profil.png"
                        alt="User Photo" />
                    <span class="text-sm">{{ $datauser['firstName'] }} {{ $datauser['lastName'] }} ({{session('loadid')}})</span>
                </div>
            </div>
        @else
            <div class="flex items-center space-x-4">
                &nbsp;
            </div>
        @endif
      </header>
      <div class="flex  ">
        <div>
            @yield('main-content')

    </div>
    <div>
        <aside
          class="w-80 bg-[#EEEEEE] border-l border-gray-200 p-4 space-y-8 hidden lg:block">
          <!-- Loyalty Summary -->
            <div class="bg-[#1C1C1C] p-4 space-y-8 rounded-xl">
                @if(isset($islogin) && $islogin)
                    <h2 class="text-sm font-semibold text-white mb-2">
                    Loyalty Summary
                    </h2>
                    <p class="text-sm text-white">
                        Total Points
                        <span class="float-right text-white font-bold">6700 Pts</span>
                    </p>
                    <p class="text-sm text-white">
                        Lots Collected
                        <span class="float-right text-white font-bold"> {{ number_format($totalVolume ?? 0, 2) }} Lots</span>
                    </p>
                    <p class="text-sm text-white">
                        Your Ranking
                        <span class="float-right text-white font-bold">Bronze</span>
                    </p>

                    <a href="{{ route('logout') }}" class="btn">Logout</a>
                @else
                    <!-- Display login form if not logged in -->
                    <form method="post" action="{{ route('login.process') }}">
                        @csrf <!-- This directive is important for CSRF protection -->
                        <h2 class="text-xl font-bold text-white mb-2">
                            Login
                        </h2>
                        <p class="text-sm text-white">
                            <span class="text-sm">Email</span><br>

                            <input type="text" name="email" value="" class="form-control" style="color:black;width:250px;height:30px;padding-left:5px;">
                        </p>
                        <br>
                        <p class="text-sm text-white">
                            <span class="text-sm">Password</span><br>
                            <input type="password" name="password" value="" class="form-control" style="color:black;width:250px;height:30px;padding-left:5px;">
                        </p>
                        <br>
                        <p class="text-sm text-white">
                            <button type="submit" class="btn">Submit</button>
                        </p>
                    </form>
                @endif
            </div>

            <!-- Balance Info -->
            @if(isset($islogin) && $islogin)
            <div class="bg-[#1C1C1C] p-4 rounded-xl space-y-2">
                <div class="space-y-8">
                    <div
                        class="w-40 h-14 bg-black flex rounded-full items-center px-4">
                        <p class="text-sm text-white font-medium">
                            Live Account ({{ $loginID }})
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-white">Balance</p>
                        <p class="text-xl text-white font-bold">$ {{ number_format($balance ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl space-y-8">
                <h3 class="text-sm font-bold mb-2">Quick Access</h3>
                <div class="flex items-center space-x-4 justify-between">
                    <div>
                        <img
                            class="flex items-center"
                            src="assets/images/Group 341.png"
                            alt="" />
                        <button class="text-sm text-black py-2 rounded-md">
                            Deposit
                        </button>
                    </div>
                    <div>
                        <img
                            class="flex items-center"
                            src="assets/images/2.png"
                            alt="" />
                        <button class="text-sm text-black py-2 rounded-md">
                            Withdraw
                        </button>
                    </div>
                    <div>
                        <img
                            class="flex items-center"
                            src="assets/images/Group 345.png"
                            alt="" />
                        <button class="text-sm text-black py-2 rounded-md">
                            Transfer
                        </button>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center gap-6">
                    <h3 class="text-sm font-semibold mb-2">Open Live Account</h3>
                    <h3 class="text-sm font-semibold mb-2">Open Demo Account</h3>
                </div>
            </div>

            <!-- Account Manager -->
            <div class="bg-gray-100 p-4 rounded-md">
                <h3 class="text-sm font-bold">My Account Manager</h3>
                <div class="flex flex-col pt-5 items-center gap-6 space-x-3 mt-3">
                <img
                    class="w-auto h-auto rounded-full object-cover"
                    src="assets/images/profil.png"
                    alt="Mona Foto" />
                <div>
                    <p class="text-sm font-semibold">Mona Hanalina</p>
                    <p class="text-xs text-gray-500">mona@vestrado.com</p>
                </div>
                </div>
                <div class="flex items-center justify-center mt-3">
                <button class="bg-gray-50 text-white px-2 py-1 rounded text-xs">
                    <img src="assets/images/telpon.png" alt="" />
                </button>
                <button class="bg-gray-50 text-white px-2 py-1 rounded text-xs">
                    <img src="assets/images/sms.png" alt="" />
                </button>
                <button class="bg-gray-50 text-white px-2 py-1 rounded text-xs">
                    <img src="assets/images/email.png" alt="" />
                </button>
                </div>
            </div>
            @endif
        </aside>
    </div>
      </div>
      </div>
    </div>
    <footer class="bg-white mt-8 p-6 border-t border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
          <!-- Services -->
          <div>
            <h4 class="font-semibold mb-2">Services</h4>
            <ul class="space-y-1">
              <li>
                <a href="#" class="text-gray-600 hover:underline">Contacts</a>
              </li>
              <li><a href="#" class="text-gray-600 hover:underline">FAQ</a></li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Tutorial Videos</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Economic Calendar</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Forex Calculator</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >IB Programme</a
                >
              </li>
            </ul>
          </div>
          <!-- Legal Terms -->
          <div>
            <h4 class="font-semibold mb-2">Legal Terms</h4>
            <ul class="space-y-1">
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Risk Disclosure</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Privacy Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Return Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline">Language</a>
              </li>
            </ul>
          </div>
          <!-- About -->
          <div>
            <h4 class="font-semibold mb-2">About</h4>
            <ul class="space-y-1">
              <li>
                <a href="#" class="text-gray-600 hover:underline">About Us</a>
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Privacy Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline"
                  >Return Policy</a
                >
              </li>
              <li>
                <a href="#" class="text-gray-600 hover:underline">Language</a>
              </li>
            </ul>
          </div>
          <!-- Social Media -->
          <div>
            <h4 class="font-semibold mb-2">Social Media</h4>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-600 hover:text-green-600"><img src="assets/images/Facebook F.png" alt=""></a>
              <a href="#" class="text-gray-600 hover:text-green-600"><img src="assets/images/Twitter Bird.png" alt=""></a>
              <a href="#" class="text-gray-600 hover:text-green-600"><img src="assets/images/Instagram.png" alt=""></a>
            </div>
          </div>
        </div>

        <!-- Disclaimer -->
        <div class="mt-6 text-xs text-gray-500">
          <p>
            Risk Warning: Trading Forex and CFDs involves significant risk and
            can result in the loss of your invested capital. You should not
            invest more than you can afford to lose and should ensure that you
            fully understand the risks involved...
          </p>
          <p class="mt-2">
            Restrictions: Vestrado Ltd are unable to service clients under
            certain jurisdictions ...
          </p>
        </div>
      </footer>
      <div id="alertModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-98 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <div class="flex gap-4 items-center">
                <div>
                    <img src="assets/images/Thumb1_Campus.png" alt="Hoodie" class="w-40 h-40 rounded-md mb-4">
                </div>
                <div>
                    <h2 class="text-lg font-semibold">Vestrado Campus Hoodie</h2>
                    <p class="text-gray-500 text-sm">SKU: 928633</p>
                    <p class="text-gray-500 text-sm">Size: XXL</p>
                    <p class="text-gray-500 text-sm">Color: Black</p>
                    <p class="font-bold text-lg mt-2">300PTS / 50LOTS</p>
                </div>
            </div>
            <div class="mt-4 flex">

              <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
            <div>
              <span class="text-sm text-gray-700 peer-checked:text-green-600">I want to redeem this merchandise using my points</span>
              <p class="text-xs text-gray-500 ">(My Current Points: <strong>350pts</strong>)</p>
            </div>
            </div>
            <div class="mt-2 flex">
              <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
                <div>
                  <span class="text-sm text-gray-700">I want to redeem this merchandise using my lots</span>
                  <p class="text-xs text-gray-500 ">(My Current Lots: <strong>{{ number_format($totalVolume ?? 0, 2) }}Lots</strong>)</p>
                </div>
            </div>
            <button onclick="closeModal()" class="w-full bg-black text-white py-2 mt-4 rounded-lg text-center hover:bg-gray-800 transition">PLACE ORDER</button>
        </div>
      </div>
      <script>
        document.getElementById('getThisBtn').addEventListener('click', function() {
          document.getElementById('alertModal').classList.remove('hidden');
        });
        function closeModal() {
          document.getElementById('alertModal').classList.add('hidden');
        }
      </script>
  </body>
</html>

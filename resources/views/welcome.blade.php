<!DOCTYPE html>
<html class="bg-gray-900"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect"
        href="https://fonts.googleapis.com">
    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet"
        href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"
        defer></script>
</head>

<body class="h-screen antialiased bg-gray-900 font-poppins">

    <div class="relative h-full overflow-hidden">
        <header class="relative">
            <div class="pt-6 bg-gray-900">
                <nav class="relative flex items-center justify-between px-4 mx-auto max-w-7xl sm:px-6"
                    aria-label="Global">
                    <div class="flex items-center flex-1">
                        <div class="flex items-center justify-between w-full md:w-auto">
                            <a href="#">
                                <span class="sr-only">Workflow</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-10 h-10 text-blue-500"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                    <path
                                        d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                </svg>
                            </a>
                            <div class="flex items-center -mr-2 md:hidden">
                                <button type="button"
                                    class="inline-flex items-center justify-center p-2 text-gray-400 bg-gray-900 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white"
                                    aria-expanded="false">
                                    <span class="sr-only">Open main menu</span>
                                    <!-- Heroicon name: outline/menu -->
                                    <svg class="w-6 h-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="hidden space-x-8 md:flex md:ml-10">

                        </div>
                    </div>
                    <div class="hidden md:flex md:items-center md:space-x-6">

                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-gray-600 border border-transparent rounded-md hover:bg-gray-700">
                            Log in </a>
                    </div>
                </nav>
            </div>

            <!--
      Mobile menu, show/hide based on menu open state.

      Entering: "duration-150 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
      Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
            <div class="absolute inset-x-0 top-0 z-10 p-2 transition origin-top transform md:hidden">
                <div class="overflow-hidden bg-white rounded-lg shadow-md ring-1 ring-black ring-opacity-5">
                    <div class="flex items-center justify-between px-5 pt-4">
                        <div>
                            <img class="w-auto h-8"
                                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                                alt="">
                        </div>
                        <div class="-mr-2">
                            <button type="button"
                                class="inline-flex items-center justify-center p-2 text-gray-400 bg-white rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                                <span class="sr-only">Close menu</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="w-6 h-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="pt-5 pb-6">
                        <div class="px-2 space-y-1">

                        </div>
                        <div class="px-5 mt-6">

                        </div>
                        <div class="px-5 mt-6">

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="h-full pt-10 bg-gray-900 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                <div class="mx-auto max-w-7xl lg:px-8">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                        <div
                            class="max-w-md px-4 mx-auto sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center">
                            <div class="lg:py-24">

                                <h1
                                    class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl">
                                    <span class="block font-bold">Text Mo</span>
                                </h1>
                                <p class="mt-3 text-base text-gray-100 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                    The Supreme Student Council of Mindanao State University, General Santos City, will
                                    distribute campus-related text message to students using the system...
                                </p>
                                <div class="mt-10 sm:mt-12">
                                    <div>
                                        <h1 class="text-white ">
                                            By logging in, you agree to our <a href="#"
                                                class="font-bold text-blue-600">Terms of Service</a> and
                                            <a href="#"
                                                class="font-bold text-blue-600">Privacy Policy</a>.
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0 lg:relative">
                            <div class="max-w-md px-4 mx-auto sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0">
                                <!-- Illustration taken from Lucid Illustrations: https://lucid.pixsellz.io/ -->
                                <svg data-name="Layer 1"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                                    viewBox="0 0 965.9983 727.77798"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M843.99644,259.05824h-3.99878V149.51291a63.40188,63.40188,0,0,0-63.4018-63.4019H544.50913a63.40183,63.40183,0,0,0-63.402,63.40171V750.48713A63.40181,63.40181,0,0,0,544.509,813.889H776.59556a63.40185,63.40185,0,0,0,63.402-63.40167V337.0345h3.99884Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#3f3d56" />
                                    <path
                                        d="M779.15391,102.606h-30.295a22.49487,22.49487,0,0,1-20.82715,30.99053H595.07231A22.4948,22.4948,0,0,1,574.24516,102.606h-28.2956a47.34782,47.34782,0,0,0-47.34784,47.34774V750.04628a47.34781,47.34781,0,0,0,47.34778,47.34784H779.15391a47.34781,47.34781,0,0,0,47.34784-47.34778h0V149.95372A47.34778,47.34778,0,0,0,779.15391,102.606Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#fff" />
                                    <ellipse cx="593.85804"
                                        cy="272.70788"
                                        rx="42"
                                        ry="4"
                                        fill="#e6e6e6" />
                                    <polygon
                                        points="965.998 99.868 579.346 99.868 579.346 226.799 593.992 226.799 593.992 259.997 627.189 226.799 965.998 226.799 965.998 99.868"
                                        fill="#1ea2d8" />
                                    <rect x="622.38123"
                                        y="142.85169"
                                        width="175.8208"
                                        height="5.33572"
                                        fill="#fff" />
                                    <rect x="622.38123"
                                        y="161.30963"
                                        width="306.4409"
                                        height="5.33572"
                                        fill="#fff" />
                                    <rect x="622.38123"
                                        y="179.76757"
                                        width="306.14082"
                                        height="5.33572"
                                        fill="#fff" />
                                    <polygon
                                        points="867.219 482.708 558.58 482.708 558.58 584.029 570.271 584.029 570.271 610.528 596.77 584.029 867.219 584.029 867.219 482.708"
                                        fill="#1ea2d8" />
                                    <rect x="592.93168"
                                        y="517.01913"
                                        width="140.34624"
                                        height="4.25916"
                                        fill="#fff" />
                                    <rect x="592.93168"
                                        y="531.7529"
                                        width="244.61173"
                                        height="4.25916"
                                        fill="#fff" />
                                    <rect x="592.93168"
                                        y="546.48667"
                                        width="244.37219"
                                        height="4.25915"
                                        fill="#fff" />
                                    <ellipse cx="570.16348"
                                        cy="620.67483"
                                        rx="33.52585"
                                        ry="3.19294"
                                        fill="#e6e6e6" />
                                    <ellipse cx="477.85804"
                                        cy="420.70788"
                                        rx="42"
                                        ry="4"
                                        fill="#e6e6e6" />
                                    <polygon
                                        points="220.435 298.894 492.342 298.894 492.342 388.157 482.042 388.157 482.042 411.502 458.697 388.157 220.435 388.157 220.435 298.894"
                                        fill="#1ea2d8" />
                                    <rect x="248.63846"
                                        y="328.43529"
                                        width="123.643"
                                        height="3.75226"
                                        fill="#fff" />
                                    <rect x="248.63846"
                                        y="341.41553"
                                        width="215.49937"
                                        height="3.75226"
                                        fill="#fff" />
                                    <rect x="248.63846"
                                        y="354.39577"
                                        width="215.28834"
                                        height="3.75226"
                                        fill="#fff" />
                                    <path
                                        d="M204.98483,602.7405a9.78852,9.78852,0,1,0,16.92928-9.83159,10.53624,10.53624,0,0,0-.9219-1.308l8.23429-58.68943.24657-1.75834,1.67262-11.97588.24657-1.72615-.91143.04286-15.95345.72906-4.27813.193-.53607,10.9252-3.03427,61.42346A9.77533,9.77533,0,0,0,204.98483,602.7405Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#a0616a" />
                                    <path
                                        d="M229.4257,531.68727l-20.25776-1.85846a3.99888,3.99888,0,0,1-3.607-4.32839l3.75749-42.12687a15.3597,15.3597,0,1,1,30.495,3.59966l-6.07429,41.32067a3.99223,3.99223,0,0,1-3.94387,3.41014C229.67305,531.704,229.54951,531.69879,229.4257,531.68727Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#ccc" />
                                    <path
                                        d="M214.07315,497.65142a28.21468,28.21468,0,0,1,10.37684-32.473c7.63906-5.22672,18.09252-7.103,29.35008,6.29888C276.3152,498.281,282.212,527.76513,282.212,527.76513l-46.10241,7.505S220.42959,516.1057,214.07315,497.65142Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#ccc" />
                                    <polygon
                                        points="171.635 713.464 184.779 713.464 191.032 662.764 171.633 662.765 171.635 713.464"
                                        fill="#a0616a" />
                                    <path
                                        d="M285.81933,795.81915H327.13a0,0,0,0,1,0,0V811.7801a0,0,0,0,1,0,0H298.56648a12.74715,12.74715,0,0,1-12.74715-12.74715v-3.2138A0,0,0,0,1,285.81933,795.81915Z"
                                        transform="translate(495.98517 1521.47425) rotate(179.99738)"
                                        fill="#2f2e41" />
                                    <polygon
                                        points="63.569 702.001 76.049 706.126 97.899 659.951 79.48 653.863 63.569 702.001"
                                        fill="#a0616a" />
                                    <path
                                        d="M175.52575,789.741h41.31068a0,0,0,0,1,0,0V805.702a0,0,0,0,1,0,0H188.2729a12.74715,12.74715,0,0,1-12.74715-12.74715V789.741A0,0,0,0,1,175.52575,789.741Z"
                                        transform="translate(15.10144 1530.59796) rotate(-161.70982)"
                                        fill="#2f2e41" />
                                    <circle cx="243.01104"
                                        cy="425.55219"
                                        r="26.33308"
                                        transform="translate(-291.34132 82.60127) rotate(-28.66321)"
                                        fill="#a0616a" />
                                    <path
                                        d="M266.06749,785.461l-12.207-80.56614a3.75242,3.75242,0,0,0-7.35715-.32143l-18.58881,76.77906a4.85983,4.85983,0,0,1-5.455,3.629l-51.27548-8.2411a4.82491,4.82491,0,0,1-3.85172-6.16485l66.86011-220.42923a3.755,3.755,0,0,0,.06544-1.93175l-2.22623-9.6462a4.807,4.807,0,0,1,2.49453-5.37541c9.10436-4.64563,32.15923-14.30334,49.56673-3.72425a4.87892,4.87892,0,0,1,2.22937,3.13792L338.55324,778.092a4.82479,4.82479,0,0,1-4.2886,5.80991l-62.99634,5.64135q-.2179.01886-.43242.01885A4.83333,4.83333,0,0,1,266.06749,785.461Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#2f2e41" />
                                    <path
                                        d="M225.54983,406.9472a19.9212,19.9212,0,0,0,5.20571-4.52412,6.75719,6.75719,0,0,0,1.03951-6.53714c-1.33042-2.93506-5.28406-3.86472-8.34727-2.86408s-5.42991,3.4005-7.66876,5.71828c-1.9721,2.04162-4.00046,4.17254-4.93595,6.85251s-.45491,6.07742,1.87182,7.70336c2.28336,1.59564,5.56625.94244,7.76241-.77123s3.55559-4.25658,4.85181-6.72226Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#2f2e41" />
                                    <path
                                        d="M216.63126,399.44407c-.146-7.41974-8.60343-12.73986-15.90723-11.42514s-12.91811,7.54234-15.72839,14.41084c-5.93767,14.512-1.48029,31.07023,4.24088,45.669s12.80109,29.41864,11.96661,45.07617a47.0938,47.0938,0,0,1-27.35559,39.67436c8.24307,3.73638,18.096-.12353,25.02277-5.94832,15.38319-12.93585,21.32109-35.96587,14.11048-54.72715-3.55648-9.25358-9.82407-17.17-14.7173-25.79168s-8.48341-18.782-5.95709-28.3682,13.27757-17.35024,22.46924-13.6367Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#2f2e41" />
                                    <path
                                        d="M244.59023,437.23754c-2.29531-3.87938-4.61289-8.97211-.416-12.36286a8.64563,8.64563,0,0,1,6.487-1.71526c4.73071.57031,9.88213.80529,14.4607-.91335a13.55629,13.55629,0,0,0,7.86369-7.06606c2.36387-5.60074-.59621-12.40665-5.5379-15.94725a18.65352,18.65352,0,0,0-20.64725-.36516c-6.40048-2.82676-14.16647-1.5699-19.98124,2.32179s-9.79374,10.124-11.95533,16.77864a32.38559,32.38559,0,0,0-.98945,17.81332,26.47371,26.47371,0,0,0,16.422,18.09656,9.5332,9.5332,0,0,0,9.41588-1.39713s3.62943-3.16816,4.7651-6.9842C245.34969,442.5656,245.81659,439.31026,244.59023,437.23754Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#2f2e41" />
                                    <path
                                        d="M322.70929,460.73441a11.28449,11.28449,0,0,0-.25656,1.75846l-46.05679,26.57-11.19475-6.44462-11.93427,15.62365,18.70937,13.3349a8.57717,8.57717,0,0,0,10.29069-.25071l47.49247-37.46713a11.25445,11.25445,0,1,0-7.05016-13.12453Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#a0616a" />
                                    <path
                                        d="M274.85621,490.32129,259.97078,509.6135a4.82471,4.82471,0,0,1-7.29482.39956l-16.85132-17.49877a13.39909,13.39909,0,0,1,16.43245-21.16866l21.13523,11.81807a4.82469,4.82469,0,0,1,1.46389,7.15759Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#ccc" />
                                    <path
                                        d="M426.27387,813.889H118.253a1.25212,1.25212,0,0,1,0-2.50424h308.0209a1.25212,1.25212,0,0,1,0,2.50424Z"
                                        transform="translate(-117.00085 -86.11101)"
                                        fill="#ccc" />
                                </svg>
                                {{-- <img class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                                    src="https://tailwindui.com/img/component-images/cloud-illustration-indigo-400.svg"
                                    alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More main page content here... -->
        </main>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Subscription Plans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

<div class="relative py-24 overflow-hidden" x-data="{ annual: false }">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-100 blur-[120px] opacity-50"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-100 blur-[120px] opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-indigo-600 font-bold tracking-widest uppercase text-sm mb-3">Pricing Plans</h2>
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6">
                Ready to upgrade your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">workflow?</span>
            </h1>
            <p class="text-lg text-slate-600 leading-relaxed">
                Choose a plan that fits your ambition. From solo learners to global enterprises.
            </p>

            <div class="mt-12 flex justify-center items-center">
                <span class="text-sm font-semibold transition-all" :class="!annual ? 'text-slate-900' : 'text-slate-400'">Monthly</span>
                <button @click="annual = !annual"
                        class="mx-4 relative inline-flex h-7 w-14 items-center rounded-full bg-slate-200 transition-colors focus:outline-none shadow-inner">
                    <span :class="annual ? 'translate-x-8 bg-indigo-600' : 'translate-x-1 bg-white'"
                          class="inline-block h-5 w-5 transform rounded-full transition-all duration-300 shadow-sm"></span>
                </button>
                <span class="text-sm font-semibold transition-all" :class="annual ? 'text-slate-900' : 'text-slate-400'">Yearly</span>
                <span class="ml-3 inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-bold text-green-800 ring-1 ring-inset ring-green-600/20 shadow-sm">
                    Save 20%
                </span>
            </div>
        </div>

        <div class="mt-20 grid grid-cols-1 gap-8 lg:grid-cols-3 items-center">

            <div class="glass-effect rounded-3xl p-10 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 flex flex-col h-full">
                <h3 class="text-slate-900 font-bold text-xl">Starter</h3>
                <p class="text-slate-500 mt-2 text-sm leading-relaxed">Perfect for beginners exploring AWS S3 features.</p>

                <div class="mt-8 flex items-baseline">
                    <span class="text-5xl font-black tracking-tight text-slate-900">$0</span>
                    <span class="ml-1 text-slate-500 font-medium">/mo</span>
                </div>

                <ul class="mt-10 space-y-4 flex-1">
                    <li class="flex items-start text-sm font-medium text-slate-600">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3"></i>
                        <span>Public Profile Uploads</span>
                    </li>
                    <li class="flex items-start text-sm font-medium text-slate-600">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3"></i>
                        <span>500MB Monthly Storage</span>
                    </li>
                    <li class="flex items-start text-sm font-medium text-slate-600 opacity-50">
                        <i class="fa-solid fa-circle-xmark text-slate-300 mt-1 mr-3"></i>
                        <span>Private Signed URLs</span>
                    </li>
                </ul>

                <a href="#" class="mt-10 block w-full py-4 px-6 text-center text-sm font-bold text-slate-900 bg-slate-100 rounded-2xl hover:bg-slate-200 transition-colors">Start for free</a>
            </div>

            <div class="relative rounded-3xl p-10 shadow-2xl ring-2 ring-indigo-600 bg-white scale-105 z-10 flex flex-col h-full">
                <div class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2">
                    <span class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-1.5 rounded-full text-xs font-black uppercase tracking-widest shadow-lg">Most Popular</span>
                </div>

                <h3 class="text-slate-900 font-bold text-xl">Pro Developer</h3>
                <p class="text-slate-500 mt-2 text-sm leading-relaxed">Advanced security and larger file handling.</p>

                <div class="mt-8 flex items-baseline">
                    <span class="text-5xl font-black tracking-tight text-indigo-600" x-text="annual ? '$19' : '$24'">$24</span>
                    <span class="ml-1 text-slate-500 font-medium">/mo</span>
                </div>

                <ul class="mt-10 space-y-4 flex-1">
                    <li class="flex items-start text-sm font-bold text-slate-700">
                        <i class="fa-solid fa-circle-check text-indigo-500 mt-1 mr-3"></i>
                        <span>Unlimited Public Uploads</span>
                    </li>
                    <li class="flex items-start text-sm font-bold text-slate-700">
                        <i class="fa-solid fa-circle-check text-indigo-500 mt-1 mr-3"></i>
                        <span>Private Signed URLs</span>
                    </li>
                    <li class="flex items-start text-sm font-bold text-slate-700">
                        <i class="fa-solid fa-circle-check text-indigo-500 mt-1 mr-3"></i>
                        <span>10GB S3 Storage</span>
                    </li>
                    <li class="flex items-start text-sm font-bold text-slate-700">
                        <i class="fa-solid fa-circle-check text-indigo-500 mt-1 mr-3"></i>
                        <span>Priority Support</span>
                    </li>
                </ul>

                <a href="#" class="mt-10 block w-full py-4 px-6 text-center text-sm font-bold text-white bg-indigo-600 rounded-2xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all">Get Pro Access</a>
            </div>

            <div class="glass-effect rounded-3xl p-10 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 flex flex-col h-full">
                <h3 class="text-slate-900 font-bold text-xl">Enterprise</h3>
                <p class="text-slate-500 mt-2 text-sm leading-relaxed">Ultimate performance for heavy data.</p>

                <div class="mt-8 flex items-baseline">
                    <span class="text-5xl font-black tracking-tight text-slate-900" x-text="annual ? '$79' : '$99'">$99</span>
                    <span class="ml-1 text-slate-500 font-medium">/mo</span>
                </div>

                <ul class="mt-10 space-y-4 flex-1">
                    <li class="flex items-start text-sm font-medium text-slate-600">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3"></i>
                        <span>Everything in Pro</span>
                    </li>
                    <li class="flex items-start text-sm font-medium text-slate-600">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3"></i>
                        <span>Pre-signed Heavy Uploads</span>
                    </li>
                    <li class="flex items-start text-sm font-medium text-slate-600">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3"></i>
                        <span>Custom CORS Configuration</span>
                    </li>
                </ul>

                <a href="#" class="mt-10 block w-full py-4 px-6 text-center text-sm font-bold text-slate-900 border-2 border-slate-200 rounded-2xl hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all">Contact Sales</a>
            </div>

        </div>

        <p class="text-center mt-12 text-slate-500 text-sm italic">
            Prices are in USD. Secure payment via Stripe. No credit card required for Starter plan.
        </p>
    </div>
</div>

</body>
</html>

{{-- resources/views/dashboard/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeekMed Dashboard</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- SIDEBAR -->
    <div class="flex">

        <aside class="w-64 bg-white shadow-lg h-screen fixed p-6">
            <h1 class="text-2xl font-bold text-blue-600 mb-8">SeekMed</h1>

            <nav class="space-y-3">
                <a href="/dashboard" class="flex items-center p-3 rounded-xl bg-blue-50 text-blue-600 font-semibold">
                    <span class="material-icons mr-2">dashboard</span> Dashboard
                </a>
                <a href="#" class="flex items-center p-3 rounded-xl hover:bg-gray-100">
                    <span class="material-icons mr-2">person</span> Profile
                </a>
                <a href="/logout" class="flex items-center p-3 rounded-xl hover:bg-gray-100">
                    <span class="material-icons mr-2">logout</span> Logout
                </a>
            </nav>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="ml-64 w-full p-8">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Hi, {{ auth()->user()->name }}</h2>
                <p class="text-gray-500">Welcome back 👋</p>
            </div>

            <!-- METRIC CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="p-6 bg-white rounded-2xl shadow-md">
                    <p class="text-sm text-gray-500">Doctors Available</p>
                    <h1 class="text-4xl font-bold text-blue-600 mt-2">{{ $doctorsCount }}</h1>
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-md">
                    <p class="text-sm text-gray-500">Articles</p>
                    <h1 class="text-4xl font-bold text-blue-600 mt-2">{{ count($articles) }}</h1>
                </div>

                <div class="p-6 bg-white rounded-2xl shadow-md">
                    <p class="text-sm text-gray-500">Active Consultations</p>
                    <h1 id="cons-count" class="text-4xl font-bold text-blue-600 mt-2">0</h1>
                </div>

            </div>

            <!-- DOCTOR SEARCH -->
            <div class="bg-white p-6 rounded-2xl shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4">Search Doctors</h3>

                <div class="flex gap-3">
                    <input id="doctor-search"
                           type="text"
                           placeholder="Search doctor name or specialty..."
                           class="w-full px-4 py-3 border rounded-xl focus:ring-2 ring-blue-400 outline-none">
                    <button id="search-btn"
                        class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">
                        Search
                    </button>
                </div>

                <div id="doctor-results" class="mt-6 space-y-4"></div>
            </div>

            <!-- CONSULTATION + ARTICLES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- CONSULTATION HISTORY -->
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Consultation History</h3>
                    <div id="consultation-list" class="space-y-4"></div>
                    <button id="load-more-cons" class="text-blue-600 font-semibold mt-3">Load more</button>
                </div>

                <!-- ARTICLES -->
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Articles</h3>

                    @foreach ($articles as $a)
                        <div class="border-b pb-3 mb-3">
                            <a href="/articles/{{ $a->slug }}"
                               class="text-lg font-semibold text-blue-600 hover:underline">
                                {{ $a->title }}
                            </a>
                            <p class="text-sm text-gray-500">{{ $a->excerpt }}</p>
                        </div>
                    @endforeach

                    <a href="/articles" class="mt-3 inline-block text-blue-600 hover:underline">
                        View all →
                    </a>
                </div>

            </div>

        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

// RENDER DOCTOR RESULT
function renderDoctors(items) {
    const wrap = document.getElementById('doctor-results');
    if (items.length === 0) {
        wrap.innerHTML = `<p class="text-gray-500">No doctors found.</p>`;
        return;
    }

    wrap.innerHTML = items.map(d => `
        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
            <img src="${d.photo_url || 'https://via.placeholder.com/60'}"
                class="w-14 h-14 rounded-xl object-cover">

            <div>
                <p class="font-semibold">${d.name}</p>
                <p class="text-sm text-gray-500">${d.specialty} — 
                    ${d.available ? '🟢 Available' : '🔴 Unavailable'}
                </p>
            </div>
        </div>
    `).join('');
}

// Search doctors
document.getElementById("search-btn").onclick = () => {
    const q = document.getElementById('doctor-search').value;
    axios.get("{{ route('api.doctors.search') }}", { params: { q }})
        .then(res => renderDoctors(res.data.data));
};

// CONSULTATION PAGINATION
let consPage = 1;
function loadConsultations() {
    axios.get("{{ route('api.consultations') }}", { params: { page: consPage }})
        .then(res => {
            const data = res.data.data ?? res.data;
            const wrap = document.getElementById('consultation-list');

            data.forEach(c => {
                wrap.innerHTML += `
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="font-semibold">${c.doctor?.name ?? 'Doctor'}</p>
                        <p class="text-sm text-gray-500">${c.status}</p>
                        <p class="text-sm mt-1">${c.notes ?? ''}</p>
                    </div>
                `;
            });

            document.getElementById('cons-count').innerText =
                wrap.children.length;

            if (!res.data.next_page_url)
                document.getElementById('load-more-cons').style.display = "none";
        });
}
loadConsultations();

document.getElementById('load-more-cons').onclick = () => {
    consPage++;
    loadConsultations();
};
</script>

</body>
</html>

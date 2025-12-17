@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-[#0E6973] via-[#118C8C] to-[#0E6973] text-white overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-48 h-48 md:w-72 lg:w-96 md:h-72 lg:h-96 bg-[#F2BB16] rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 md:w-72 lg:w-96 md:h-72 lg:h-96 bg-[#BAD9CE] rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
            Jelajahi Kampus Peserta Expo
        </h1>
        <p class="text-base sm:text-lg text-[#BAD9CE] max-w-3xl mx-auto leading-relaxed">
            Temukan berbagai perguruan tinggi terbaik dari seluruh Indonesia yang akan hadir di Magetan Campus Expo 2026. Pilih daerah asal untuk melihat kampus-kampus di wilayah Anda.
        </p>
    </div>
</section>

<!-- Ormada/Region Grid Section -->
<section class="relative py-12 sm:py-16 lg:py-24 bg-gradient-to-b from-white to-[#BAD9CE]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="text-center mb-12 lg:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-3">
                Organisasi Mahasiswa Daerah
            </h2>
            <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                Ikatan Mahasiswa Magetan di berbagai wilayah Indonesia yang siap membantu Anda menemukan kampus impian
            </p>
        </div>

        <!-- Ormada Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
            <!-- Ormada Card 1: IMMS -->
            <button onclick="openOrmadaModal('surabaya')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <!-- Decorative Background -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <!-- Logo Container -->
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/imms-logo.png') }}" alt="IMMS Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <!-- Organization Name -->
                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">IMMS</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Ikatan Mahasiswa Magetan di Surabaya</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Surabaya</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 2: Pamelo -->
            <button onclick="openOrmadaModal('solo')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/pamelo-logo.png') }}" alt="Pamelo Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">PAMELO</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Paguyuban Mahasiswa Magetan Solo</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Solo</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 3: KOMMMA -->
            <button onclick="openOrmadaModal('malang')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/kommma-logo.png') }}" alt="KOMMMA Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">KOMMMA</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Komunitas Mahasiswa Magetan di Malang</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Malang</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 4: IMPATA -->
            <button onclick="openOrmadaModal('bogor')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/impata-logo.png') }}" alt="IMPATA Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">IMPATA</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Ikatan Mahasiswa dan Alumni Pelajar di Bogor</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Bogor</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 5: IMAGINER -->
            <button onclick="openOrmadaModal('jember')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/imaginer-logo.png') }}" alt="IMAGINER Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">IMAGINER</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Ikatan Mahasiswa Magetan ing Jember</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Jember</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 6: IMAGES -->
            <button onclick="openOrmadaModal('semarang')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/images-logo.png') }}" alt="IMAGES Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">IMAGES</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Ikatan Mahasiswa Magetan di Semarang</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Semarang</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 7: FOMAGTA -->
            <button onclick="openOrmadaModal('yogyakarta')" class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-full text-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/fomagta-logo.png') }}" alt="FOMAGTA Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">FOMAGTA</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Forum Mahasiswa Magetan Yogyakarta</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">Yogyakarta</span>
                    </div>
                </div>
            </button>

            <!-- Ormada Card 8: IMAMA (TIDAK BISA DIKLIK) -->
            <div class="group relative bg-white hover:bg-gradient-to-br hover:from-[#118C8C]/5 hover:to-[#0E6973]/5 p-8 rounded-3xl border-2 border-gray-200 hover:border-[#118C8C] hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 w-full">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#118C8C]/5 rounded-full blur-2xl group-hover:bg-[#118C8C]/10 transition-all"></div>

                <div class="relative flex flex-col items-center justify-center space-y-4">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#118C8C]/10 to-[#0E6973]/5 flex items-center justify-center overflow-hidden border-2 border-[#118C8C]/20 group-hover:border-[#118C8C] group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <img src="{{ asset('images/ormada/imama-logo.png') }}" alt="IMAMA Logo" class="w-24 h-24 object-contain" onerror="this.parentElement.innerHTML='<div class=\'text-4xl\'>🎓</div>'">
                    </div>

                    <div class="text-center space-y-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#118C8C] transition-colors">IMAMA</h3>
                        <p class="text-sm text-gray-600 leading-snug px-2">Ikatan Mahasiswa Magetan UNESA</p>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-[#118C8C] bg-[#118C8C]/10 rounded-full">UNESA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Campus Detail -->
<div id="campusModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-[#0E6973] to-[#118C8C] text-white p-6 sm:p-8 flex justify-between items-center">
            <h2 id="modalTitle" class="text-2xl sm:text-3xl font-bold">IMMS (Ikatan Mahasiswa Magetan di Surabaya)</h2>
            <button onclick="closeCampusModal()" class="text-white hover:bg-white/20 p-2 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6 sm:p-8">
            <div id="campusGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Campus cards akan di-generate dengan JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Campus Data -->
<script>
    const campusData = {
        'surabaya': {
            title: 'Universitas di Surabaya',
            ormada: 'IMMS',
            campuses: [{
                    name: 'Universitas Airlangga',
                    city: 'Surabaya',
                    contact: '+62-31-5033-0000',
                    logo: '/images/universities/unair.png'
                },
                {
                    name: 'ITS (Institut Teknologi Sepuluh Nopember)',
                    city: 'Surabaya',
                    contact: '+62-31-5947-0000',
                    logo: '/images/universities/its.png'
                },
                {
                    name: 'PENS (Politeknik Elektronika Negeri Surabaya)',
                    city: 'Surabaya',
                    contact: '+62-31-5947-0000',
                    logo: '/images/universities/pens.png'
                },
                {
                    name: 'PPNS (Politeknik Perkapalan Negeri Surabaya)',
                    city: 'Surabaya',
                    contact: '+62-31-5947-0000',
                    logo: '/images/universities/ppns.png'
                },
                {
                    name: 'Universitas Negeri Surabaya (UNESA)',
                    city: 'Surabaya',
                    contact: '+62-31-8280-0000',
                    logo: '/images/universities/unesa.png'
                },
                {
                    name: 'Universitas Nahdatul Ulama Surabaya (UNUSA)',
                    city: 'Surabaya',
                    contact: '+62-31-2983-0000',
                    logo: '/images/universities/unusa.png'
                },
                {
                    name: 'Universitas Islam Negeri Sunan Ampel Surabaya',
                    city: 'Surabaya',
                    contact: '+62-31-2981-0000',
                    logo: '/images/universities/uinsa.png'
                },
                {
                    name: 'Universitas Hang Tuah Surabaya',
                    city: 'Surabaya',
                    contact: '+62-31-2981-0000',
                    logo: '/images/universities/uht.png'
                },
                {
                    name: 'UPN Veteran Jawa Timur',
                    city: 'Surabaya',
                    contact: '+62-31-2981-0000',
                    logo: '/images/universities/upnjatim.png'
                },
                {
                    name: 'Telkom University',
                    city: 'Surabaya',
                    contact: '+62-31-2981-0000',
                    logo: '/images/universities/telkom.png'
                },
                {
                    name: 'Poltekes Kemenkes Surabaya',
                    city: 'Surabaya',
                    contact: '+62-31-2981-0000',
                    logo: '/images/universities/poltekessby.png'
                },
            ]
        },
        'solo': {
            title: 'Universitas di Solo',
            ormada: 'PAMELO',
            campuses: [{
                    name: 'Universitas Sebelas Maret',
                    city: 'Solo',
                    contact: '+62-271-632-163',
                    logo: '/images/universities/uns.png'
                },
                {
                    name: 'Universitas Muhammadiyah Surakarta',
                    city: 'Solo',
                    contact: '+62-271-717-417',
                    logo: '/images/universities/ums.png'
                },
                {
                    name: 'Poltekes Surakarta',
                    city: 'Solo',
                    contact: '+62-271-715-145',
                    logo: '/images/universities/poltekesskt.png'
                },
                {
                    name: 'ISI (Institut Seni Indonesia)',
                    city: 'Solo',
                    contact: '+62-271-647-658',
                    logo: '/images/universities/isiskt.png'
                },
                {
                    name: 'UIN Raden Mas Said Surakarta',
                    city: 'Solo',
                    contact: '+62-271-626-129',
                    logo: '/images/universities/uinskt.png'
                },
            ]
        },
        'malang': {
            title: 'Universitas di Malang',
            ormada: 'KOMMMA',
            campuses: [{
                    name: 'Universitas Brawijaya (UB)',
                    city: 'Malang',
                    contact: '+62-341-551-312',
                    logo: '/images/universities/ub.png'
                },
                {
                    name: 'Universitas Negeri Malang (UM)',
                    city: 'Malang',
                    contact: '+62-341-551-312',
                    logo: '/images/universities/um.png'
                },
                {
                    name: 'Universitas Islam Negeri (UIN) Maulana Malik Ibrahim',
                    city: 'Malang',
                    contact: '+62-341-552-112',
                    logo: '/images/universities/uin-malang.png'
                },
                {
                    name: 'Universitas Muhammadiyah Malang',
                    city: 'Malang',
                    contact: '+62-341-464-318',
                    logo: '/images/universities/unimma.png'
                },
                {
                    name: 'STIE Malangkucecwara',
                    city: 'Malang',
                    contact: '+62-341-402-145',
                    logo: '/images/universities/stie-malang.png'
                },
            ]
        },
        'bogor': {
            title: 'Universitas di Bogor',
            ormada: 'IMPATA',
            campuses: [{
                    name: 'Institut Pertanian Bogor (IPB)',
                    city: 'Bogor',
                    contact: '+62-251-862-1951',
                    logo: '/images/universities/ipb.png'
                },
                {
                    name: 'Universitas Pakuan',
                    city: 'Bogor',
                    contact: '+62-251-835-1945',
                    logo: '/images/universities/unpak.png'
                },
                {
                    name: 'STMIK Profesional Bogor',
                    city: 'Bogor',
                    contact: '+62-251-837-9100',
                    logo: '/images/universities/stmik-bogor.png'
                },
                {
                    name: 'Universitas Indonesia (UI) - Kampus Depok',
                    city: 'Depok',
                    contact: '+62-21-7270-0570',
                    logo: '/images/universities/ui.png'
                },
                {
                    name: 'Universitas Terbuka',
                    city: 'Bogor',
                    contact: '+62-251-841-506',
                    logo: '/images/universities/ut.png'
                },
            ]
        },
        'jember': {
            title: 'Universitas di Jember',
            ormada: 'IMAGINER',
            campuses: [{
                    name: 'Universitas Jember (UNEJ)',
                    city: 'Jember',
                    contact: '+62-331-487-000',
                    logo: '/images/universities/unej.png'
                },
                {
                    name: 'Universitas Muhammadiyah Jember',
                    city: 'Jember',
                    contact: '+62-331-487-466',
                    logo: '/images/universities/unmuh-jember.png'
                },
                {
                    name: 'Universitas Islam Jember',
                    city: 'Jember',
                    contact: '+62-331-425-911',
                    logo: '/images/universities/uij.png'
                },
                {
                    name: 'STIE Jember',
                    city: 'Jember',
                    contact: '+62-331-482-900',
                    logo: '/images/universities/stie-jember.png'
                },
                {
                    name: 'Universitas Kanjuruhan Malang - Kampus Jember',
                    city: 'Jember',
                    contact: '+62-331-333-000',
                    logo: '/images/universities/unikama.png'
                },
            ]
        },
        'semarang': {
            title: 'Universitas di Semarang',
            ormada: 'IMAGES',
            campuses: [{
                    name: 'Universitas Diponegoro (UNDIP)',
                    city: 'Semarang',
                    contact: '+62-24-7460-057',
                    logo: '/images/universities/undip.png'
                },
                {
                    name: 'Universitas Negeri Semarang (UNNES)',
                    city: 'Semarang',
                    contact: '+62-24-8508-112',
                    logo: '/images/universities/unnes.png'
                },
                {
                    name: 'Universitas Dian Nuswantoro',
                    city: 'Semarang',
                    contact: '+62-24-3520-700',
                    logo: '/images/universities/udinus.png'
                },
                {
                    name: 'Universitas Soegijapranata',
                    city: 'Semarang',
                    contact: '+62-24-8441-555',
                    logo: '/images/universities/unika-semarang.png'
                },
                {
                    name: 'Universitas Stikubank',
                    city: 'Semarang',
                    contact: '+62-24-3588-800',
                    logo: '/images/universities/stikubank.png'
                },
            ]
        },
        'yogyakarta': {
            title: 'Universitas di Yogyakarta',
            ormada: 'FOMAGTA',
            campuses: [{
                    name: 'Universitas Gadjah Mada (UGM)',
                    city: 'Yogyakarta',
                    contact: '+62-274-514-207',
                    logo: '/images/universities/ugm.png'
                },
                {
                    name: 'Universitas Islam Negeri (UIN) Sunan Kalijaga',
                    city: 'Yogyakarta',
                    contact: '+62-274-519-839',
                    logo: '/images/universities/uin-yogyakarta.png'
                },
                {
                    name: 'Universitas Atma Jaya Yogyakarta',
                    city: 'Yogyakarta',
                    contact: '+62-274-562-188',
                    logo: '/images/universities/uajy.png'
                },
                {
                    name: 'Universitas Pembangunan Nasional Veteran',
                    city: 'Yogyakarta',
                    contact: '+62-274-487-256',
                    logo: '/images/universities/upn-yogyakarta.png'
                },
                {
                    name: 'Universitas Mercu Buana Yogyakarta',
                    city: 'Yogyakarta',
                    contact: '+62-274-387-436',
                    logo: '/images/universities/umby.png'
                },
            ]
        }
    };

    function openOrmadaModal(region) {
        const data = campusData[region];
        if (!data) return;

        document.getElementById('modalTitle').textContent = data.title;

        const campusGrid = document.getElementById('campusGrid');
        campusGrid.innerHTML = data.campuses.map(campus => `
            <div class="group bg-gradient-to-br from-[#118C8C]/20 to-white p-6 rounded-xl border border-[#118C8C]/30 hover:border-[#118C8C] hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col items-center text-center space-y-3">
                    <!-- Logo Campus -->
                    <div class="w-24 h-24 bg-gradient-to-br from-[#118C8C]/20 to-[#0E6973]/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-md overflow-hidden">
                        <img src="${campus.logo}" alt="${campus.name}" class="w-20 h-20 object-contain" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23118C8C%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%22 y=%2250%22 font-size=%2220%22 fill=%22white%22 text-anchor=%22middle%22 dy=%22.3em%22%3E🏫%3C/text%3E%3C/svg%3E'">
                    </div>
                    
                    <!-- Campus Info -->
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm mb-1">${campus.name}</h3>
                        <p class="text-xs text-gray-600 mb-3">${campus.city}</p>
                    </div>
                    
                    <!-- Contact Button -->
                    <a href="tel:${campus.contact}" class="w-full px-4 py-2 bg-gradient-to-r from-[#118C8C] to-[#0E6973] text-white text-xs font-semibold rounded-lg hover:shadow-lg transition-all hover:from-[#0E6973] hover:to-[#118C8C]">
                        📞 Hubungi
                    </a>
                </div>
            </div>
        `).join('');

        document.getElementById('campusModal').classList.remove('hidden');
    }

    function closeCampusModal() {
        document.getElementById('campusModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('campusModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCampusModal();
        }
    });
</script>

@endsection
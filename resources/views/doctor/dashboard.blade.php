@extends('layouts.doctor')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/6917913_Motion_Graphics_Motion_Graphic_3840x2160.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <!-- Hero Content -->
        <div class="max-w-7xl z-20 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden text-center sm:rounded-lg">
                <button class="p-3 py-2 bg-gray-100 border-2 text-[#696473] uppercase font-medium font-Inter text-sm border-white rounded-full">• Transform Medical Data Into Actionable Insights</button>
                <h1 class="mt-6 text-[86px] w-[80%] mx-auto font-satoshi font-semibold leading-[6rem] text-[#302B3D]">
                    Complexity to clarity with Medilens-AI
                </h1>
                <p class="mt-6 text-[18px] font-Inter max-w-xl mx-auto text-[#646070]">
                    MediLens AI helps doctors, patients, and hospitals make sense of unstructured healthcare data. From X-rays and prescriptions to lab reports and voice notes – we turn complexity into clarity.
                </p>
            </div>
            {{-- <a href="{{route('files.index')}}" class="text-black">Create your file</a>
             --}}
             <div class="flex text-center justify-center items-center mt-10 gap-4">                
                <!-- Assure-toi d'avoir chargé la librairie (CDN ou via npm) -->
                <div class="p-1 border-2 border-white rounded-full hover:scale-105 transition-transform duration-300 ease-in-out">
                    <a href="{{ route('questions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <i class="ph ph-arrow-right text-[26px] text-white font-semibold mr-3 text-lg"></i>
                    Answer patient
                    </a>
                </div>
                <div class="p-1 border-2 border-white rounded-full hover:scale-105 transition-transform duration-300 ease-in-out">
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <i class="ph ph-plus text-[26px] text-white font-semibold mr-3 text-lg"></i>
                    Create poste
                    </a>
                </div>
             </div>
        </div>
    </section>

    <!-- Next Section (normal background) -->
    <section class="py-20 bg-gray-50">
        <div class="z-20 mx-auto flex flex-col sm:px-6 lg:px-8">
            <div class="py-4 overflow-hidden mx-auto text-center sm:rounded-lg">
                <button class="p-3 py-2 border-2 shadow-md bg-gray-100 text-[#663038] uppercase items-center justify-center flex font-medium font-Inter text-sm border-white rounded-full"><span class="ph ph-chart-bar text-[#BFB4D9] mr-1 text-md"></span> Process</button>
            </div>
            <div class="flex text-center items-center justify-evenly">
                <div class="mx-auto w-64 h-1.5 bg-gradient-to-t from-white via-[#BFB4D9] to-[#BFB4D9] rounded-full"></div>
                <h2 class="text-[44px]  font-normal text-[#1C1629] mb-6">Process Is Performance</h2>
                <div class="mx-auto w-64 h-1.5 bg-gradient-to-t from-white via-[#BFB4D9] to-[#BFB4D9] rounded-full"></div>
            </div>
            <p class="max-w-2xl text-center font-Inter mx-auto text-gray-600">
                Strategic, Medilens-AI steps to build and simplified an medical document, smarter, and stronger with measurable results
            </p>
        </div>
        <div class="relative w-[85vw] z-20 grid grid-cols-3 gap-4 mx-auto mt-[5rem] flex-col sm:px-6 lg:px-8">
            <!-- Cercle en dégradé -->
            <div class="absolute inset-0 top-32 flex justify-center items-center">
                <div class="w-[90vw] h-[300px] rounded-full bg-gradient-to-tr from-gray-300 to-white blur-3xl opacity-70"></div>
            </div>
            <div class="flex-col px-7 shadow-lg pb-16 pt-8 border border-white rounded-2xl bg-[#F4F4FF] items-start justify-items-start lg:flex-row relative z-30">
                <div class="flex items-center text-[35px]">
                    1.
                    <i class="ph ph-share-network p-2 rounded-xl shadow-md ml-3 border border-white text-[#3C1D88] text-[35px]"></i>
                </div>
                <h3 class="font-satoshi text-[24px] font-semibold mt-7">Workflow Assessment</h3>
                <p class="text-[16px] mt-3 text-start font-Inter text-[#1c1629]">We start by analyzing your current medical and administrative workflows to uncover where AI can make the biggest difference — improving speed, accuracy, and clarity.</p>
                <p class="inline-flex mt-7 space-x-2 px-6 py-2 rounded-full border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#161615] shadow-md hover:shadow-lg">Step 1</p>
            </div>
            <div class="flex-col px-7 shadow-lg pb-16 pt-8 border border-white rounded-2xl bg-[#F4F4FF] items-start justify-items-start lg:flex-row relative z-30">
                <div class="flex items-center text-[35px]">
                    2.
                    <i class="ph ph-rocket-launch p-2 rounded-xl shadow-md ml-3 border border-white text-[#3C1D88] text-[35px]"></i>
                </div>
                <h3 class="font-satoshi text-[24px] font-semibold mt-7">Custom AI Deployment</h3>
                <p class="text-[16px] mt-3 text-start font-Inter text-[#1c1629]">Our team designs and deploys tailored AI solutions that align with your healthcare goals, ensuring seamless, secure, and compliant integration within your environment.</p>
                <p class="inline-flex mt-7 space-x-2 px-6 py-2 rounded-full border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#161615] shadow-md hover:shadow-lg">Step 2</p>
            </div>
            <div class="flex-col px-7 shadow-lg pb-16 pt-8 border border-white rounded-2xl bg-[#F4F4FF] items-start justify-items-start lg:flex-row relative z-30">
                <div class="flex items-center text-[35px]">
                    3.
                    <i class="ph ph-share-network p-2 rounded-xl shadow-md ml-3 border border-white text-[#3C1D88] text-[35px]"></i>
                </div>
                <h3 class="font-satoshi text-[24px] font-semibold mt-7">Continuous Optimization</h3>
                <p class="text-[16px] mt-3 text-start font-Inter text-[#1c1629]">We monitor real-world results, refine the models, and adapt the system based on your feedback to guarantee lasting performance and trustworthy outcomes.</p>
                <p class="inline-flex mt-7 space-x-2 px-6 py-2 rounded-full border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#161615] shadow-md hover:shadow-lg">Step 3</p>
            </div>
        </div>
        <h2 class="font-satoshi text-[35px] text-center font-semibold mt-16">Our Technology</h2>
        <div class="relative items-center w-[80vw] z-20 justify-evenly mx-auto mt-[5rem] flex sm:px-6">
            <h3 class="font-satoshi text-[16px] font-semibold">Document Question Answering</h3>
            <div class="w-0 h-12 border border-gray-800"></div>
            <h3 class="font-satoshi text-[16px] font-semibold">Visual Question Answering</h3>
            <div class="w-0 h-12 border border-gray-800"></div>
            <h3 class="font-satoshi text-[16px] font-semibold">Speech-to-Text</h3>
            <div class="w-0 h-12 border border-gray-800"></div>
            <h3 class="font-satoshi text-[16px] font-semibold">Summarization</h3>
            <div class="w-0 h-12 border border-gray-800"></div>
            <h3 class="font-satoshi text-[16px] font-semibold">Text Generation</h3>
        </div>
    </section>
    <section class="relative bg-white py-[7rem] w-full mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl grid grid-cols-2 justify-between mx-auto sm:px-6 lg:px-8">
            <!-- Cercle en dégradé -->
                <div class="absolute z-0 inset-0 top-32 flex justify-center items-center">
                    <div class="w-full h-[300px] rounded-full bg-gradient-to-tr from-gray-300 to-white blur-3xl opacity-70"></div>
                </div>
            <div class="flex-col justify-center px-7 z-20">
                <button class="p-3 py-2 border-2 shadow-md bg-gray-100 text-[#663038] uppercase items-center justify-center flex font-medium text-sm border-white rounded-full"><span class="ph ph-star text-[#BFB4D9] mr-1 text-md"></span> Value </button>
                <h2 class="text-[44px]  font-normal text-[#1C1629] mb-6 mt-6">Our Values</h2>
                <div class="ml-14 text-gray-600 font-Inter">
                    <ul class="list-disc space-y-4 text-gray-600 font-Inter text-[16px]">
                        <li><span class="text-[16px] font-satoshi font-semibold text-[#1C1629]">Ethics & Transparency</span>: We prioritize medical data privacy, transparency, and compliance with healthcare standards like GDPR and HIPAA.</li>
                        <li><span class="text-[16px] font-satoshi font-semibold text-[#1C1629]">Human-Centered AI</span>: MediLens AI supports doctors — it doesn’t replace them. Our goal is to make human expertise even more powerful through automation.</li>
                        <li><span class="text-[16px] font-satoshi font-semibold text-[#1C1629]">Innovation with Purpose</span>: We experiment with technology that brings real value to healthcare — not just theoretical AI.</li>
                        <li><span class="text-[16px] font-satoshi font-semibold text-[#1C1629]">Accessibility for All</span>: Whether you’re a doctor in a hospital or a patient seeking clarity, MediLens AI ensures simplicity and inclusivity in every feature.</li>
                    </ul>
                </div>
            </div>
            <div class="items-end justify-end flex z-20 border border-spacing-2 border-white p-3 backdrop-blur-sm bg-white/20 shadow-md rounded-3xl">
                <img src="{{ asset('img/doctor-working-laptop-with-brain-image-background-cardiologist-doctor-work.jpg') }}" alt="Our Values" class="w-full h-auto rounded-3xl shadow-lg">
            </div>
        </div>
    </section>
    <section class="relative bg-white py-[7rem] w-full mx-auto sm:px-6 lg:px-8">
        <!-- Cercle en dégradé -->
                <div class="absolute z-0 mx-auto inset-0 top-32 flex justify-center items-center">
                    <div class="w-full h-[500px] rounded-full bg-gradient-to-tr from-gray-400/50 to-white blur-3xl opacity-70"></div>
                </div>
                <div class="max-w-6xl flex z-20 justify-between mx-auto">
                    <h2 class="text-[44px] z-20 font-normal text-[#1C1629] mb-6 mt-6">Questions answered</h2>
                </div>
        <div class="max-w-6xl justify-between gap-5 grid grid-cols-2 mx-auto">
            <div x-data="{ open: 0 }" class="space-y-4 z-20">
                <!-- Item 1 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 1 ? open = null : open = 1"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">What is MediLens AI?</span>
                        <span :class="open === 1 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 1" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        MediLens AI is a multimodal healthcare assistant powered by artificial intelligence.
                        It analyzes medical documents, images, and voice notes to deliver structured insights, summaries, and patient-friendly explanations.
                    </div>
                </div>
    
                <!-- Item 2 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 2 ? open = null : open = 2"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Who can use MediLens AI?</span>
                        <span :class="open === 2 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 2" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        MediLens AI is designed for:
                        <ul class="list-disc space-y-4 text-gray-600 font-Inter text-[14px]">
                            <li>Doctors, who want quick insights from reports and images.</li>
                            <li>Patients, who want to understand their health data in simple terms.</li>
                            <li>Hospitals and Clinics, who need to organize and search through large collections of medical data efficiently.</li>
                        </ul>
                    </div>
                </div>
    
                <!-- Item 3 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 3 ? open = null : open = 3"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">How does MediLens AI process medical data?</span>
                        <span :class="open === 3 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 3" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        When you upload a document, prescription, or image:

                        <ul class="list-disc space-y-4 text-gray-600 font-Inter text-[14px]">
                            <li>It’s securely stored and analyzed by specialized AI models.</li>
                            <li>Text, visuals, and context are extracted using HuggingFace models.</li>
                            <li>The system then generates insights, summaries, and relevant questions — all orchestrated through a Laravel backend.</li>
                        </ul>
                    No human ever sees your uploaded data — everything runs automatically and securely.
                    </div>
                </div>
    
                <!-- Item 4 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 4 ? open = null : open = 4"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Is my medical data safe?</span>
                        <span :class="open === 4 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 4" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        Absolutely. MediLens AI is built with GDPR and HIPAA compliance in mind.
                        All uploads are encrypted and stored on secure cloud servers. You always remain the sole owner of your medical data.
                    </div>
                </div>
            </div>
            {{-- ---------------------------- --}}
            <div x-data="{ open: 0 }" class="space-y-4 z-20">
                <!-- Item 1 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 1 ? open = null : open = 1"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Does MediLens AI replace doctors?</span>
                        <span :class="open === 1 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 1" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        No — it supports, not replaces, human expertise.
                        MediLens AI helps doctors analyze and summarize data faster, so they can focus on what truly matters: patient care and decision-making.
                    </div>
                </div>
    
                <!-- Item 2 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 2 ? open = null : open = 2"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Can MediLens AI detect diseases automatically?</span>
                        <span :class="open === 2 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 2" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        MediLens AI can identify patterns and anomalies in medical images or reports using pretrained models.
However, it does not provide diagnoses — it assists doctors by highlighting potential areas of concern for further review.
                    </div>
                </div>
    
                <!-- Item 3 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 3 ? open = null : open = 3"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Which AI technologies are used?</span>
                        <span :class="open === 3 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 3" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        MediLens AI combines multiple AI capabilities, including:

                        <ul class="list-disc space-y-4 text-gray-600 font-Inter text-[14px]">
                            <li>Document Question Answering</li>
                            <li>Visual Question Answering</li>
                            <li>Image-to-Text (OCR)</li>
                            <li>Summarization</li>
                            <li>Translation</li>
                            <li>Image Classification</li>
                            <li>Text Generation</li>
                        </ul>
                        This combination makes it a true multimodal assistant — capable of understanding both text and images.
                    </div>
                </div>
    
                <!-- Item 4 -->
                <div class="border border-white border-spacing-3 shadow-md bg-white/40 rounded-2xl p-4">
                    <button @click="open === 4 ? open = null : open = 4"
                            class="w-full flex justify-between items-center text-left">
                        <span class="font-semibold text-lg text-[#1c1629]">Can I integrate MediLens AI into my hospital system?</span>
                        <span :class="open === 4 ? 'rotate-180' : ''" class="transition-transform ph ph-caret-down text-2xl text-[#381885]"></span>
                    </button>
                    <div x-show="open === 4" x-collapse class="mt-3 text-gray-600 leading-relaxed">
                        Yes, the platform supports FHIR/HL7 APIs, making it compatible with hospital information systems for automated workflows and data integration.
                    </div>
                </div>
            </div>
        </div>
        <div class="items-center justify-center mt-7 w-full flex">
            <button class="p-3 py-2 flex border-spacing-3 items-center z-20 bg-gray-100 border-2 font-semibold text-[#1c1629] font-satoshi text-[16px] border-white rounded-full"><span class="ph ph-envelope mr-2 text-[24px]"></span> Feel free to mail us for any enquiries :  <a href="mailto:meroelhosni123@gmail.com" class="lowercase underline font-satoshi ml-3 text-[16px] font-semibold">meroelhosni123@gmail.com</a></button>
        </div>
    </section>

    <section class="relative bg-white py-[7rem] w-full mx-auto sm:px-6 lg:px-8">
         <!-- Cercle en dégradé -->
                <div class="absolute z-0 mx-auto inset-0 top-32 flex justify-center items-center">
                    <div class="w-full h-[500px] rounded-full bg-gradient-to-tr from-gray-400/50 to-white blur-3xl opacity-70"></div>
                </div>
        <div class="flex z-20 text-center items-center justify-evenly">
            <div class="mx-auto w-64 h-1.5 bg-gradient-to-t from-white via-[#BFB4D9] to-[#BFB4D9] rounded-full"></div>
            <h2 class="text-[44px]  font-normal text-[#1C1629] mb-6">Process Is Performance</h2>
            <div class="mx-auto w-64 h-1.5 bg-gradient-to-t from-white via-[#BFB4D9] to-[#BFB4D9] rounded-full"></div>
        </div>
        <div class="flex z-20 w-full mt-5 gap-5 justify-between max-w-6xl mx-auto">
            <div class="max-w-[40%] z-20">
                <img class="rounded-xl shadow-md shadow-black/20 " src="{{asset('img/doctor-from-future-conce.jpg')}}" alt="">
            </div>
            <div class="z-20">
                <video autoplay muted loop playsinline class="w-full shadow-md shadow-black/20 rounded-xl h-full object-cover z-0">
                    <source src="{{ asset('videos/quote-sec22.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="flex gap-5 z-20 mt-5 w-full mx-auto max-w-6xl">
            <div class="flex-col px-7 shadow-lg pb-16 border-spacing-5 pt-8 border border-white rounded-2xl bg-[#F4F4FF] items-start justify-items-start lg:flex-row relative z-30">
                <a href="https://www.linkedin.com/in/marwane-elhosni/" target="_blank">
                    <div class="flex items-center text-[35px]">
                        <i class="ph ph-browser p-2 rounded-xl shadow-md mr-3 border border-white text-[#3C1D88] text-[35px]"></i>
                        <h3 class="font-satoshi text-[24px] font-semibold">Product designer</h3>
                    </div>
                    <p class="text-[16px] mt-3 text-start font-Inter text-[#1c1629]">looking for a product designer who really cares about the user experience and a team player who shapes our product</p>
                    <p class="inline-flex mt-7 space-x-2 px-6 py-2 rounded-full border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#664BA1] shadow-md hover:shadow-lg">+2 years exp</p>
                </a>
            </div>
            <div class="flex-col px-7 shadow-lg pb-16 border-spacing-5 pt-8 border border-white rounded-2xl bg-[#F4F4FF] items-start justify-items-start lg:flex-row relative z-30">
                <a href="https://www.linkedin.com/in/marwane-elhosni/" target="_blank">
                    <div class="flex items-center text-[35px]">
                        <i class="ph ph-code p-2 rounded-xl shadow-md mr-3 border border-white text-[#3C1D88] text-[35px]"></i>
                        <h3 class="font-satoshi text-[24px] font-semibold">Full stack developer</h3>
                    </div>
                    <p class="text-[16px] mt-3 text-start font-Inter text-[#1c1629]">looking for a back-end developer who have knowledge on dealing with complex codebase and who can communicate as a team</p>
                    <p class="inline-flex mt-7 space-x-2 px-6 py-2 rounded-full border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#664BA1] shadow-md hover:shadow-lg">+2 years exp</p>
                </a>
            </div>
        </div>
        <div class="max-w-2xl z-20 mt-5 flex gap-7 justify-center mx-auto">
            {{-- Add Contact route --}}
            <div class="p-1 z-20 border-2 shadow-sm hover:bg-white/30 border-gray-300/50 rounded-full hover:scale-105 transition-transform duration-300 ease-in-out">
                <a href="{{ route('contact') }}" class="inline-flex items-center px-5 py-3 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-[#391986] hover:bg-none focus:outline-none transition ease-in-out duration-150">
                Contact us now
                </a>
            </div>
        </div>
    </section>
    <section class="relative bg-white py-[9rem] w-full mx-auto sm:px-6 lg:px-8">
        <div class="relative items-center justify-center flex flex-col bg-gray-100 max-w-5xl mx-auto shadow-md shadow-black/35 border border-white border-spacing-5 py-12 rounded-3xl">
            <!-- Cercle en dégradé -->
            <div class="absolute z-0 mx-auto inset-0 top-20 flex justify-center items-center">
                <div class="w-full h-[200px] rounded-full bg-gradient-to-tr from-gray-400/50 to-white blur-3xl opacity-70"></div>
            </div>
            <div class="flex flex-col z-20">
                <h2 class="text-[44px] text-center z-50 font-normal text-[#1C1629] mb-6">What you still waiting!!</h2>
            </div>
            <p class="text-center font-Inter z-20 flex max-w-2xl">
                Ready to transform healthcare with intelligent insights? MediLens AI helps you unlock the power of medical data — saving time, reducing errors, and accelerating better patient outcomes.
            </p>
            <p class="mt-7 space-x-2 px-6 py-2 rounded-xl border border-white/30 backdrop-blur-sm font-Inter bg-white/20 hover:bg-white/30 transition duration-300 text-[15px] font-semibold text-[#664BA1] flex items-center shadow-md hover:shadow-lg"><i class="ph ph-money text-xl mr-2"></i>100% safe payment</p>
            {{-- create post --}}
            <div class="p-1 border-2 mt-5 z-20 shadow-sm border-white rounded-full hover:scale-105 transition-transform duration-300 ease-in-out">                
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-5 py-3 border border-transparent shadow-lg shadow-black/35 border-[#8264CA] text-md leading-4 font-bold font-Inter rounded-full text-gray-100 bg-gradient-to-r from-[#391986] to-[#6D54A7] hover:text-[#391986] hover:bg-none focus:outline-none transition ease-in-out duration-150">
                    Create a feed poste
                    <i class="ph ph-arrow-right text-[26px]  text-white font-semibold ml-3 text-lg"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

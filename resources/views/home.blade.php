@extends('layouts.app')

@section('content')
<style>
    /* Scoped responsive adjustments for the new layout */
    .hero-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 3rem;
        position: relative;
        z-index: 2;
        padding-top: 5rem;
    }
    .hero-content {
        flex: 1 1 500px;
        text-align: left;
        margin: 0;
        max-width: 100%;
    }
    .hero-visual {
        flex: 1 1 400px;
        max-width: 100%;
    }
    @media (max-width: 768px) {
        .hero-container {
            padding-top: 2rem;
            text-align: center;
        }
        .hero-content {
            text-align: center;
        }
        .hero-content p {
            margin-inline: auto;
        }
        .hero-stats {
            justify-content: center;
        }
        .hero-btns {
            justify-content: center;
        }
    }

    /* NFT Gallery Style Cards */
    .nft-card {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .nft-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(56, 189, 248, 0.2);
        border-color: rgba(56, 189, 248, 0.4);
    }
    .nft-card-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #1e1b4b, #0f172a);
        border-radius: 14px;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.5);
        position: relative;
        overflow: hidden;
    }

    /* Horizontal Path Cards */
    .path-card {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s ease, background 0.3s ease;
    }
    .path-card:hover {
        transform: translateX(5px);
        background: rgba(30, 41, 59, 0.8);
        border-color: rgba(56, 189, 248, 0.3);
    }
    .path-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(56, 189, 248, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #38bdf8;
        font-size: 1.2rem;
        box-shadow: inset 0 0 10px rgba(56, 189, 248, 0.2);
    }
</style>

<!-- SECTION 1 - HERO -->
<section class="hero" id="home" style="height: auto; min-height: 100vh; padding: 100px 0 50px;">
    <div class="hero-bg-shapes">
        <div class="shape shape-1" style="background: rgba(79, 70, 229, 0.4); box-shadow: 0 0 100px rgba(79, 70, 229, 0.6);"></div>
        <div class="shape shape-2" style="background: rgba(14, 165, 233, 0.3); box-shadow: 0 0 100px rgba(14, 165, 233, 0.5);"></div>
    </div>
    <div class="container hero-container">
        <div class="hero-content">
            <h1 style="margin-bottom: 1.5rem; text-shadow: 0 0 20px rgba(255,255,255,0.1); font-size: 3.5rem; line-height: 1.2;">
                Master Photography &<br> <span style="color: #38bdf8; text-shadow: 0 0 20px rgba(56, 189, 248, 0.4);">Videography Visually</span>
            </h1>
            <p style="margin-bottom: 2.5rem; max-width: 100%; font-size: 1.1rem; color: #cbd5e1;">
                Learn photography and videography through visual-based lessons designed to improve understanding faster and more effectively.
            </p>
            <div class="hero-btns" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('login') }}" class="btn btn-primary" style="box-shadow: 0 0 20px rgba(79, 70, 229, 0.5); padding: 0.8rem 2rem;">Start Learning</a>
                <a href="{{ route('materi') }}" class="btn btn-outline" style="border-color: rgba(255,255,255,0.2); color: white; padding: 0.8rem 2rem;">Explore Materials</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="glass-panel" style="padding: 1.2rem; border-radius: 24px; box-shadow: 0 0 50px rgba(14, 165, 233, 0.2); position: relative; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                <div style="width: 100%; height: 500px; border-radius: 16px; background: linear-gradient(135deg, #1e1b4b, #0f172a, #082f49); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; box-shadow: inset 0 0 40px rgba(0,0,0,0.5);">
                    <div style="position: absolute; width: 300px; height: 300px; background: rgba(56, 189, 248, 0.4); filter: blur(70px); border-radius: 50%; z-index: 1;"></div>
                    <img src="{{ asset('assets/images/kamera man.png') }}" alt="Hero Visual" style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px; z-index: 2; position: relative; mix-blend-mode: normal;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2 - STATS -->
<section class="section-padding" style="background: rgba(15, 23, 42, 0.4); border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);">
    <div class="container">
        <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 2rem; text-align: center;">
            <div>
                <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: #38bdf8; text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);">50+</h3>
                <span style="color: var(--text-muted); font-size: 1rem; font-weight: 500;">Learning Materials</span>
            </div>
            <div>
                <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: #818cf8; text-shadow: 0 0 15px rgba(129, 140, 248, 0.4);">10+</h3>
                <span style="color: var(--text-muted); font-size: 1rem; font-weight: 500;">Visual Modules</span>
            </div>
            <div>
                <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: #a78bfa; text-shadow: 0 0 15px rgba(167, 139, 250, 0.4);">100+</h3>
                <span style="color: var(--text-muted); font-size: 1rem; font-weight: 500;">Students Helped</span>
            </div>
            <div>
                <h3 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: #34d399; text-shadow: 0 0 15px rgba(52, 211, 153, 0.4);"><i class="fa-solid fa-check"></i></h3>
                <span style="color: var(--text-muted); font-size: 1rem; font-weight: 500;">Project-Based Learning</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3 - FEATURED MATERIALS -->
<section class="section-padding">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
            <h2 style="margin: 0; text-shadow: 0 0 15px rgba(255,255,255,0.1);">Featured Learning Materials</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
            <!-- Card 1 -->
            <div class="nft-card">
                <div class="nft-card-image">
                    <div style="position: absolute; width: 100px; height: 100px; background: rgba(56, 189, 248, 0.2); filter: blur(30px); border-radius: 50%;"></div>
                    <i class="fa-solid fa-camera" style="font-size: 3.5rem; color: rgba(255,255,255,0.8); z-index: 2;"></i>
                </div>
                <h4 style="margin-bottom: 0.5rem; font-size: 1.2rem;">Basic Photography</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Master the foundational concepts of photography.</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #38bdf8; font-size: 0.85rem; font-weight: 600;">Module</span>
                    <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="nft-card">
                <div class="nft-card-image">
                    <div style="position: absolute; width: 100px; height: 100px; background: rgba(129, 140, 248, 0.2); filter: blur(30px); border-radius: 50%;"></div>
                    <i class="fa-solid fa-crop-simple" style="font-size: 3.5rem; color: rgba(255,255,255,0.8); z-index: 2;"></i>
                </div>
                <h4 style="margin-bottom: 0.5rem; font-size: 1.2rem;">Composition Techniques</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Learn how to frame and compose stunning shots.</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #818cf8; font-size: 0.85rem; font-weight: 600;">Module</span>
                    <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="nft-card">
                <div class="nft-card-image">
                    <div style="position: absolute; width: 100px; height: 100px; background: rgba(251, 191, 36, 0.2); filter: blur(30px); border-radius: 50%;"></div>
                    <i class="fa-regular fa-lightbulb" style="font-size: 3.5rem; color: rgba(255,255,255,0.8); z-index: 2;"></i>
                </div>
                <h4 style="margin-bottom: 0.5rem; font-size: 1.2rem;">Lighting Fundamentals</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Understand natural and artificial lighting setups.</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #fbbf24; font-size: 0.85rem; font-weight: 600;">Module</span>
                    <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="nft-card">
                <div class="nft-card-image">
                    <div style="position: absolute; width: 100px; height: 100px; background: rgba(52, 211, 153, 0.2); filter: blur(30px); border-radius: 50%;"></div>
                    <i class="fa-solid fa-sliders" style="font-size: 3.5rem; color: rgba(255,255,255,0.8); z-index: 2;"></i>
                </div>
                <h4 style="margin-bottom: 0.5rem; font-size: 1.2rem;">Photo Editing</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Post-processing techniques for professional results.</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #34d399; font-size: 0.85rem; font-weight: 600;">Module</span>
                    <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="nft-card">
                <div class="nft-card-image">
                    <div style="position: absolute; width: 100px; height: 100px; background: rgba(244, 63, 94, 0.2); filter: blur(30px); border-radius: 50%;"></div>
                    <i class="fa-solid fa-video" style="font-size: 3.5rem; color: rgba(255,255,255,0.8); z-index: 2;"></i>
                </div>
                <h4 style="margin-bottom: 0.5rem; font-size: 1.2rem;">Videography Basics</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Introduction to shooting high-quality video content.</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #fb7185; font-size: 0.85rem; font-weight: 600;">Module</span>
                    <i class="fa-solid fa-arrow-right" style="color: rgba(255,255,255,0.5);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4 - LEARNING PATH -->
<section class="section-padding" style="background: rgba(15, 23, 42, 0.4);">
    <div class="container">
        <h2 style="margin-bottom: 3rem; text-shadow: 0 0 15px rgba(255,255,255,0.1); text-align: center;">Learning Path</h2>
        
        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; justify-content: center; max-width: 900px; margin: 0 auto;">
            <!-- Path Item 1 -->
            <div class="path-card">
                <div class="path-icon" style="color: #34d399; background: rgba(52, 211, 153, 0.15); box-shadow: inset 0 0 10px rgba(52, 211, 153, 0.2);">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <div style="font-size: 1.1rem; font-weight: 600;">Beginner</div>
            </div>
            
            <!-- Path Item 2 -->
            <div class="path-card">
                <div class="path-icon" style="color: #38bdf8; background: rgba(56, 189, 248, 0.15); box-shadow: inset 0 0 10px rgba(56, 189, 248, 0.2);">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div style="font-size: 1.1rem; font-weight: 600;">Intermediate</div>
            </div>
            
            <!-- Path Item 3 -->
            <div class="path-card">
                <div class="path-icon" style="color: #818cf8; background: rgba(129, 140, 248, 0.15); box-shadow: inset 0 0 10px rgba(129, 140, 248, 0.2);">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <div style="font-size: 1.1rem; font-weight: 600;">Advanced</div>
            </div>
            
            <!-- Path Item 4 -->
            <div class="path-card">
                <div class="path-icon" style="color: #a78bfa; background: rgba(167, 139, 250, 0.15); box-shadow: inset 0 0 10px rgba(167, 139, 250, 0.2);">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <div style="font-size: 1.1rem; font-weight: 600;">Editing</div>
            </div>
            
            <!-- Path Item 5 -->
            <div class="path-card">
                <div class="path-icon" style="color: #fb7185; background: rgba(244, 63, 94, 0.15); box-shadow: inset 0 0 10px rgba(244, 63, 94, 0.2);">
                    <i class="fa-solid fa-clapperboard"></i>
                </div>
                <div style="font-size: 1.1rem; font-weight: 600;">Videography</div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5 - VIDEO PREVIEW -->
<section class="section-padding">
    <div class="container" style="text-align: center;">
        <h2 style="margin-bottom: 1rem; text-shadow: 0 0 15px rgba(255,255,255,0.1);">See How You Will Learn</h2>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto 3rem auto;">
            Watch a short introduction to understand how EduAngle delivers visual-based learning.
        </p>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="glass-panel" style="padding: 1rem; border-radius: 24px; box-shadow: 0 0 50px rgba(14, 165, 233, 0.15); border-color: rgba(56, 189, 248, 0.2);">
                <div style="position: relative; width: 100%; padding-bottom: 56.25%; border-radius: 16px; overflow: hidden; box-shadow: inset 0 0 20px rgba(0,0,0,0.5);">
                    <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" 
                        src="https://www.youtube.com/embed/pj08OYLSavA" 
                        title="EduAngle Introduction Video" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6 - CTA -->
<section class="section-padding" style="padding-bottom: 8rem;">
    <div class="container">
        <div style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.9), rgba(14, 165, 233, 0.8)); border-radius: 30px; padding: 4rem 2rem; text-align: center; position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(14, 165, 233, 0.3); border: 1px solid rgba(255,255,255,0.2);">
            <div style="position: absolute; top: -50%; left: -10%; width: 60%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 60%); pointer-events: none;"></div>
            <div style="position: absolute; bottom: -50%; right: -10%; width: 50%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%); pointer-events: none;"></div>
            
            <h2 style="color: white; margin-bottom: 2.5rem; position: relative; z-index: 2; max-width: 700px; margin-inline: auto; text-shadow: 0 0 20px rgba(0,0,0,0.3);">
                Start Learning Photography the Smart Way
            </h2>
            <a href="{{ route('login') }}" class="btn btn-primary" style="background: white; color: var(--primary); padding: 1.2rem 3.5rem; font-size: 1.2rem; font-weight: 700; position: relative; z-index: 2; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-radius: 50px;">
                Join EduAngle
            </a>
        </div>
    </div>
</section>
@endsection


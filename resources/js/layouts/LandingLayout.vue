<script setup lang="ts">
import Footer from '@/landing/components/Footer.vue';
import Navbar from '@/landing/components/Navbar.vue';
import { useSweetAlert } from '@/sweet-alert/useSweetAlert';

useSweetAlert();
</script>

<template>
    <div class="landing-wrapper">
        <Navbar />
        <slot />
        <Footer />
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.landing-wrapper {
    font-family: 'poppins', 'sans-serif';
    background: #0d0d12;
    min-height: 100vh;
    overflow-x: hidden;
}

.landing-wrapper .site-header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 72px;
    padding: 0 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    z-index: 100;
    background: transparent;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.04),
        0 10px 30px rgba(0, 0, 0, 0.18);
    transition:
        height 0.3s ease,
        border-color 0.3s ease,
        box-shadow 0.3s ease;
}

.landing-wrapper .site-header::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: -1;
    background: rgba(11, 11, 17, 0.55);
    backdrop-filter: blur(16px) saturate(140%);
    -webkit-backdrop-filter: blur(16px) saturate(140%);
    transition: background 0.3s ease;
    pointer-events: none;
}

.landing-wrapper .site-header::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -1px;
    left: 0;
    height: 1px;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(167, 139, 250, 0.55),
        rgba(217, 70, 239, 0.35),
        transparent
    );
    opacity: 0.7;
    pointer-events: none;
}

.landing-wrapper .site-header.scrolled {
    height: 64px;
    border-bottom-color: rgba(167, 139, 250, 0.16);
    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.04),
        0 14px 36px rgba(0, 0, 0, 0.45);
}

.landing-wrapper .site-header.scrolled::before {
    background: rgba(10, 10, 16, 0.92);
}

.landing-wrapper .site-header.open::before {
    background: rgba(10, 10, 16, 0.97);
}

.landing-wrapper .logo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
    text-decoration: none;
    white-space: nowrap;
}

.landing-wrapper .logo-mark {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 11px;
    background: linear-gradient(135deg, #8b5cf6, #d946ef);
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
    transition: transform 0.3s ease;
}

.landing-wrapper .logo:hover .logo-mark {
    transform: rotate(-8deg) scale(1.05);
}

.landing-wrapper .logo-text {
    font-size: 1.15em;
    font-weight: 600;
    letter-spacing: -0.4px;
    color: #ffffff;
}

.landing-wrapper .logo-text span {
    color: #a78bfa;
}

.landing-wrapper .navigation {
    display: flex;
    gap: 2px;
}

.landing-wrapper .navigation a {
    text-decoration: none;
    color: rgba(255, 255, 255, 0.7);
    padding: 8px 18px;
    font-weight: 400;
    font-size: 0.9em;
    border-radius: 8px;
    transition:
        color 0.3s ease,
        background 0.3s ease;
    position: relative;
}

.landing-wrapper .navigation a:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.08);
}

.landing-wrapper .navigation a.active {
    color: #ffffff;
    background: rgba(167, 139, 250, 0.15);
    box-shadow: inset 0 0 0 1px rgba(167, 139, 250, 0.25);
}

.landing-wrapper .login-btn {
    border: 1px solid rgba(167, 139, 250, 0.4) !important;
    color: #a78bfa !important;
    margin-left: 8px;
}

.landing-wrapper .navigation a.login-btn:hover {
    background: #a78bfa !important;
    color: #ffffff !important;
    border-color: #a78bfa !important;
}

.landing-wrapper .menu-toggle {
    position: relative;
    z-index: 2;
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    padding: 8px;
    transition: background 0.3s ease;
}

.landing-wrapper .menu-toggle:hover {
    background: rgba(255, 255, 255, 0.08);
}

.landing-wrapper .menu-toggle span {
    display: block;
    width: 22px;
    height: 2px;
    background: #ffffff;
    border-radius: 2px;
    transition:
        transform 0.3s ease,
        opacity 0.3s ease;
}

.landing-wrapper .menu-toggle.open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

.landing-wrapper .menu-toggle.open span:nth-child(2) {
    opacity: 0;
}

.landing-wrapper .menu-toggle.open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}

.landing-wrapper .menu-backdrop {
    position: fixed;
    inset: 72px 0 0;
    z-index: 90;
    background: rgba(5, 5, 8, 0.55);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
}

.nav-fade-enter-active,
.nav-fade-leave-active {
    transition: opacity 0.25s ease;
}

.nav-fade-enter-from,
.nav-fade-leave-to {
    opacity: 0;
}

@media (max-width: 768px) {
    .landing-wrapper .site-header,
    .landing-wrapper .site-header.scrolled {
        height: 64px;
        padding: 0 20px;
    }

    .landing-wrapper .logo-text {
        font-size: 1.02em;
    }

    .landing-wrapper .navigation {
        position: fixed;
        top: 64px;
        left: 0;
        width: 100%;
        flex-direction: column;
        gap: 6px;
        padding: 16px 20px 24px;
        background: rgba(10, 10, 16, 0.97);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(167, 139, 250, 0.16);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
        transform: translateY(-12px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        max-height: calc(100vh - 64px);
        overflow-y: auto;
        transition:
            transform 0.25s ease,
            opacity 0.25s ease,
            visibility 0.25s ease;
    }

    .landing-wrapper .navigation.open {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .landing-wrapper .navigation a {
        padding: 13px 16px;
        font-size: 1em;
        border-radius: 10px;
    }

    .landing-wrapper .menu-toggle {
        display: flex;
    }

    .landing-wrapper .menu-backdrop {
        inset: 64px 0 0;
        display: block;
    }
}

@media (max-width: 420px) {
    .landing-wrapper .logo-mark {
        width: 30px;
        height: 30px;
        border-radius: 9px;
    }

    .landing-wrapper .logo-text {
        font-size: 0.92em;
    }
}
</style>

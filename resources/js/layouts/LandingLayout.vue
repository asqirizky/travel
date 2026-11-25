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
    background: #ffffff;
    min-height: 100vh;
    overflow-x: hidden;
    color: #0f172a;
}

html {
    scroll-behavior: smooth;
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
    border-bottom: 1px solid transparent;
    box-shadow: none;
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
    background: transparent;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
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
        rgba(59, 130, 246, 0.55),
        rgba(37, 99, 235, 0.35),
        transparent
    );
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.landing-wrapper .site-header.scrolled::after,
.landing-wrapper .site-header.open::after {
    opacity: 0.7;
}

.landing-wrapper .site-header.scrolled {
    height: 64px;
    border-bottom-color: rgba(59, 130, 246, 0.16);
    box-shadow:
        inset 0 1px 0 rgba(0, 0, 0, 0.06),
        0 14px 36px rgba(0, 0, 0, 0.1);
}

.landing-wrapper .site-header.scrolled::before,
.landing-wrapper .site-header.open::before {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(16px) saturate(140%);
    -webkit-backdrop-filter: blur(16px) saturate(140%);
}

.landing-wrapper .site-header.open::before {
    background: rgba(255, 255, 255, 0.97);
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
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
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
    color: #3b82f6;
}

.landing-wrapper .navigation {
    display: flex;
    gap: 2px;
}

.landing-wrapper .navigation a {
    text-decoration: none;
    color: #ffffff;
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
    background: rgba(255, 255, 255, 0.1);
}

.landing-wrapper .navigation a.active {
    color: #ffffff;
    background: rgba(59, 130, 246, 0.25);
    box-shadow: inset 0 0 0 1px rgba(59, 130, 246, 0.3);
}

.landing-wrapper .login-btn {
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    color: #ffffff !important;
    margin-left: 8px;
}

.landing-wrapper .navigation a.login-btn:hover {
    background: #3b82f6 !important;
    color: #ffffff !important;
    border-color: #3b82f6 !important;
}

/* Scrolled state - over white background */
.landing-wrapper .site-header.scrolled .logo,
.landing-wrapper .site-header.open .logo {
    color: #0f172a;
}

.landing-wrapper .site-header.scrolled .logo-text,
.landing-wrapper .site-header.open .logo-text {
    color: #0f172a;
}

.landing-wrapper .site-header.scrolled .logo-text span,
.landing-wrapper .site-header.open .logo-text span {
    color: #3b82f6;
}

.landing-wrapper .site-header.scrolled .navigation a,
.landing-wrapper .site-header.open .navigation a {
    color: #475569;
}

.landing-wrapper .site-header.scrolled .navigation a:hover,
.landing-wrapper .site-header.open .navigation a:hover {
    color: #0f172a;
    background: rgba(59, 130, 246, 0.08);
}

.landing-wrapper .site-header.scrolled .navigation a.active,
.landing-wrapper .site-header.open .navigation a.active {
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.15);
    box-shadow: inset 0 0 0 1px rgba(59, 130, 246, 0.25);
}

.landing-wrapper .site-header.scrolled .login-btn,
.landing-wrapper .site-header.open .login-btn {
    border: 1px solid rgba(59, 130, 246, 0.4) !important;
    color: #3b82f6 !important;
}

.landing-wrapper .site-header.scrolled .navigation a.login-btn:hover,
.landing-wrapper .site-header.open .navigation a.login-btn:hover {
    background: #3b82f6 !important;
    color: #ffffff !important;
    border-color: #3b82f6 !important;
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
    background: rgba(59, 130, 246, 0.08);
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

.landing-wrapper .site-header.scrolled .menu-toggle span,
.landing-wrapper .site-header.open .menu-toggle span {
    background: #0f172a;
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
    background: rgba(15, 23, 42, 0.08);
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
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(59, 130, 246, 0.16);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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

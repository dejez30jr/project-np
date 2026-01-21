// ===================== section navbar ==================== //
const menuBtn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");
const menuButtons = document.getElementById("menu-buttons");
const mobileMenu = document.getElementById("mobile-menu");
const mobileNav = document.getElementById("mobile-nav");
const mobileMenuClose = document.getElementById("mobile-menu-close");

// Toggle mobile menu open/close
menuBtn.addEventListener("click", () => {
    const expanded = menuBtn.getAttribute("aria-expanded") === "true" || false;
    menuBtn.setAttribute("aria-expanded", !expanded);
    if (mobileNav.classList.contains("-translate-x-full")) {
        mobileNav.classList.remove("-translate-x-full");
        mobileMenu.classList.remove("hidden");
        mobileMenu.setAttribute("aria-hidden", "false");
    } else {
        mobileNav.classList.add("-translate-x-full");
        mobileMenu.classList.add("hidden");
        mobileMenu.setAttribute("aria-hidden", "true");
    }
});

// Close mobile menu on overlay click
mobileMenu.addEventListener("click", () => {
    mobileNav.classList.add("-translate-x-full");
    mobileMenu.classList.add("hidden");
    mobileMenu.setAttribute("aria-hidden", "true");
    menuBtn.setAttribute("aria-expanded", false);
});

// Close mobile menu on close button click
mobileMenuClose.addEventListener("click", () => {
    mobileNav.classList.add("-translate-x-full");
    mobileMenu.classList.add("hidden");
    mobileMenu.setAttribute("aria-hidden", "true");
    menuBtn.setAttribute("aria-expanded", false);
});

// // scrroll navbar change bg
// // Ambil elemen header
const header = document.getElementById("header");
const navbar = document.getElementById("navbar");

// Menambahkan event listener untuk scroll
window.addEventListener("scroll", () => {
    // Jika scroll lebih dari 700px
    if (window.scrollY > 200) {
        header.classList.add("backdrop-blur-md", "text-white"); // Menambahkan background #1b2a3b dan teks putih
    } else {
        header.classList.remove("backdrop-blur-md", "text-white"); // Mengembalikan ke transparent dan teks putih
    }
});

// ================= Scroll spy - highlight menu item based on section in viewport ==================== //
document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section[id], div[id]");
    // hanya ambil nav link utama, exclude dropdown (.group div a)
    const navLinks = document.querySelectorAll(
        "#menu > a, #menu > div > a, #menu > div > button span a"
    );

    function changeActiveLink() {
        let scrollY = window.pageYOffset;

        sections.forEach((current) => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100; // offset header
            const sectionId = current.getAttribute("id");

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach((link) => {
                    link.classList.remove("text-orange-500", "font-semibold");
                    link.classList.add("text-black"); // default nav link putih
                    if (link.getAttribute("href").includes(sectionId)) {
                        link.classList.remove("text-black");
                        link.classList.add("text-black", "font-semibold");
                    }
                });
            }
        });
    }

    window.addEventListener("scroll", changeActiveLink);
});
// ==================== end Scroll spy - highlight menu item based on section in viewport ==================== //

// === Dropdown: hover + klik ===
const dropdownParents = document.querySelectorAll(".dropdown-parent");

dropdownParents.forEach((parent) => {
    const btn = parent.querySelector(".dropdown-btn");
    const menu = parent.querySelector(".dropdown-menu");

    // Hover
    parent.addEventListener("mouseenter", () => {
        menu.classList.remove("hidden");
    });
    parent.addEventListener("mouseleave", () => {
        menu.classList.add("hidden");
    });

    // Klik toggle
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        menu.classList.toggle("hidden");
    });
});

// Klik di luar untuk tutup semua
window.addEventListener("click", function (e) {
    dropdownParents.forEach((parent) => {
        const btn = parent.querySelector(".dropdown-btn");
        const menu = parent.querySelector(".dropdown-menu");

        if (!parent.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
});

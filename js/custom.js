

document.addEventListener('scroll', () => {
    const elements = document.querySelectorAll('.animate-on-scroll2, .animate-on-scroll3');
    elements.forEach((el) => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            el.classList.add('visible');
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const target = document.querySelector('.about-us-info-wrap');
    

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                target.classList.add('fade-in-up');
                observer.unobserve(target); // Stop observing after the animation
            }
        });
    });


});
document.addEventListener("DOMContentLoaded", function() {
    const target = document.querySelector('.about-us-info-wrap');
    

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                target.classList.add('fade-in-up');
                observer.unobserve(target); // Stop observing after the animation
            }
        });
    });

    
});


document.addEventListener("DOMContentLoaded", () => {
    const titles = document.querySelectorAll(".section-title-area");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.visibility = "visible";
                entry.target.style.animationName = "fadeOutUp";
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    titles.forEach((title) => {
        observer.observe(title);
    });
});


        document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".animate-on-scroll");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target); // Stop observing once animated
            }
        });
    });

    elements.forEach(element => observer.observe(element));
});
document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".animate-on-scroll1");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    });

    elements.forEach(element => observer.observe(element));
});

            
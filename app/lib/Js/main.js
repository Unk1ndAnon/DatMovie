const targets = document.querySelectorAll('.lazy');

const lazy = target => {
    const io = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-lazy');

                img.setAttribute('src', src);
                img.classList.add('fade-in');

                observer.disconnect();
            }
        });
    });

    io.observe(target);
}

targets.forEach(lazy);
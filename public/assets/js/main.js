(() => {
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
  ).matches;

  if (prefersReducedMotion) {
    return;
  }

  const work = document.querySelector(".work");
  if (!work || !("IntersectionObserver" in window)) {
    return;
  }

  work.classList.add("work--pending");

  const observer = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) {
          continue;
        }
        entry.target.classList.add("work--visible");
        entry.target.classList.remove("work--pending");
        observer.disconnect();
      }
    },
    { threshold: 0.35 }
  );

  observer.observe(work);
})();
